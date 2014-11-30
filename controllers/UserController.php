<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

class UserController extends SiteController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'new', 'create', 'activate'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['view', 'edit', 'update'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'view'   => ['get'],
                    'new'    => ['get'],
                    'create' => ['post'],
                    'edit'   => ['get'],
                    'update' => ['put'],
                    'activate' => ['get'],
                ],
            ],
        ];
    }

    public function actionNew(){}

    public function actionCreate()
    {
        $user = User::loadUser();
        if($user->save()){
            Yii::$app->mailer->compose('user/after_register', ['hash' => $user->auth_key])
                ->setFrom('nomid21@gmail.com')
                ->setTo($user->email)
                ->setSubject('Activate account')
                ->send();
            Yii::$app->session->setFlash('success', 'Activation link sent to your email: '.$user->email);
            return $this->goHome();
        }
        return ['view' => 'new'];
    }

    public function actionEdit()
    {
        if(Yii::$app->request->get('id') != Yii::$app->user->id){
            throw new ForbiddenHttpException();
        }
    }

    public function actionUpdate()
    {
        if(Yii::$app->request->get('id') != Yii::$app->user->id){
            throw new ForbiddenHttpException();
        }
        $user = User::loadUser();
        $user->load(Yii::$app->request->post());
        if($user->save()){
            Yii::$app->session->setFlash('success', 'Profile updated');
            $this->redirect('/users/'.$user->id);
        }
        return ['view' => 'edit'];
    }

    public function actionView(){}

    public function actionActivate($hash)
    {
        if(User::activate($hash)){
            Yii::$app->session->setFlash('success', 'Your account activated');
            $this->goHome();
        }
        throw new NotFoundHttpException;
    }

    public function afterAction($action, $result)
    {
        if(isset($result['view'])){
            $view = $result['view'];
        }
        else{
            $view = $action->id;
        }
        return $this->render($view, [
            'user' => User::loadUser(),
        ]);
    }
}