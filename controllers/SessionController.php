<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;
use yii\filters\VerbFilter;

class SessionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['new'],
                'rules' => [
                    [
                        'actions' => ['new', 'create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['delete'],
                    'create' => ['post'],
                ],
            ],
        ];
    }

    public function actionNew()
    {
        $user = new User();

        return $this->render('new', [
            'user' => $user,
        ]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->getRequest();
        $login_data = $request->post('User');
        $user = User::findByEmail($login_data['email']);

        if(isset($user) && $user->validatePassword($login_data['password'])){
            $this->goHome();
        }
        else{
            return $this->render('new', [
                'user'  => $user,
            ]);
        }
    }

    public function actionDelete()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
