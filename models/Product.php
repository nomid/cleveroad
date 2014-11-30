<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\data\Pagination;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $created_at
 * @property double $price
 * @property integer $user_id
 *
 * @property User $user
 */
class Product extends \yii\db\ActiveRecord
{
    private static $_product;

    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['title', 'price'], 'required'],
            [['price'], 'number'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'file'],
        ];
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'created_at' => 'Created At',
            'price' => 'Price',
            'user_id' => 'User ID',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = time();
                $this->user_id = Yii::$app->user->getId();
                $this->price = round($this->price, 2);
            }
            if ($this->validate()){
                $this->image = UploadedFile::getInstance($this, 'image');

                if($this->isAttributeChanged('image') && empty($this->image)){
                    $this->image = $this->oldAttributes['image'];
                    return true;
                }
                if($this->image){
                    if($this->image->size > 5000000){
                        $this->addError('image', 'The image is too large');
                        return false;
                    }
                    if( strpos($this->image->type, 'jpeg') === false &&
                        strpos($this->image->type, 'png') === false ){

                        $this->addError('image', 'Allowed formats: jpeg, png');
                        return false;
                    }
                    if(isset($this->getImages()[0])) $this->removeImages();

                    $file_name = 'uploads/products/'
                        .$this->image->baseName
                        .'.'.$this->image->extension;
                    $this->image->saveAs($file_name);
                }
                else{
                    $this->addError('image', 'Set image please');
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if($this->image){
            $this->attachImage('uploads/products/'.$this->image, true);
        }
    }

    public static function loadProduct()
    {
        if(isset(self::$_product)){
            return self::$_product;
        }
        if(Yii::$app->request->get('id')){
            self::$_product = self::findOne(Yii::$app->request->get('id'));
        }
        elseif(Yii::$app->request->post('User')){
            self::$_product = new self(Yii::$app->request->post('Product'));
        }
        else{
            self::$_product = new self;
        }
        return self::$_product;
    }

    public static function create($params)
    {
        $product = new self($params);
        $product->save();
        return $product;
    }

    public static function loadPaginated($query)
    {
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return [
            'products'  => $products,
            'pages'     => $pages,
        ];
    }
}
