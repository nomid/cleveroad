<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property boolean $is_activated
 * @property string $auth_key
 * @property string $access_token
 *
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $repeat_password;
    public $rememberMe;

    private static $_user;

    public static function tableName()
    {
        return 'users';
    }

    public static function loadUser()
    {
        if(isset(self::$_user)){
            return self::$_user;
        }
        if(Yii::$app->request->get('id')){
            self::$_user = User::findOne(Yii::$app->request->get('id'));
        }
        elseif(Yii::$app->request->post('User')){
            self::$_user = new User(Yii::$app->request->post('User'));
        }
        else{
            self::$_user = new User;
        }
        return self::$_user;
    }

    public static function activate($hash)
    {
        $user = self::findByAuthKey($hash);
        if($user && !$user->is_activated){
            $user->is_activated = 1;
            $user->login();
            return $user->save(false);
        }
        return false;
    }

    public static function findByEmail($email)
    {
        return self::find()->where('email="'.$email.'"')->one();
    }

    public static function findByAuthKey($auth_key)
    {
        return static::findOne(['auth_key' => $auth_key]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'repeat_password'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        if(!$this->is_activated){
            $this->addError('email', 'User is not activated');
            return false;
        }
        if(Yii::$app->getSecurity()->validatePassword($password, $this->password)){
            $this->login();
            return true;
        }
        else{
            $this->addError('password', 'Incorrect email or password');
            $this->addError('email');
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $security = Yii::$app->getSecurity();
                $this->auth_key = $security->generateRandomString();
                $this->password = $security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    public function login()
    {
        return Yii::$app->user->login($this, $this->rememberMe ? 3600*24*30 : 0);
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Your name',
            'email' => 'Email',
            'password' => 'Password',
            'repeat_password' => 'Repeat password',
        ];
    }
}