<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Product;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

class ProductController extends SiteController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => [
                            'my',
                            'index',
                            'new',
                            'create',
                            'view',
                            'edit',
                            'update' ,
                            'delete'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['get'],
                    'my'     => ['get'],
                    'view'   => ['get'],
                    'new'    => ['get'],
                    'create' => ['post'],
                    'edit'   => ['get'],
                    'update' => ['put'],
                    'delete' => ['delete'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Product::find()->orderBy('created_at DESC');

        return $this->render('index', Product::loadPaginated($query));
    }

    public function actionMy()
    {
        $query = Product::find()
            ->where('user_id='.Yii::$app->user->id);

        return $this->render('my', Product::loadPaginated($query));
    }

    public function actionView(){}

    public function actionEdit()
    {
        $product = Product::loadProduct();
        if($product->user_id != Yii::$app->user->id){
            throw new ForbiddenHttpException();
        }
    }

    public function actionUpdate()
    {
        $product = Product::loadProduct();
        if($product->user_id != Yii::$app->user->id){
            throw new ForbiddenHttpException();
        }
        $product->load(Yii::$app->request->post());
        if($product->save()){
            Yii::$app->session->setFlash('success', 'Product updated');
            $this->redirect('/products/my');
        }
        else{
            return $this->render('new', [
                'product' => $product,
            ]);
        }
    }

    public function actionNew(){}

    public function actionCreate()
    {
        $product = Product::loadProduct();
        if($product->save()){
            Yii::$app->session->setFlash('success', 'Product created');
            $this->redirect('products/my');
        }
        else{
            return $this->render('new', [
                'product' => $product,
            ]);
        }
    }

    public function actionDelete()
    {
        $app = Yii::$app;
        $product = Product::loadProduct();
        if($product->user_id != Yii::$app->user->id){
            throw new ForbiddenHttpException();
        }
        if($product->delete()){
            $app->session->setFlash('success', 'Product deleted');
        }
        else{
            $app->session->setFlash('error', 'Error deleting product');
        }

        return $this->redirect('/products/my');
    }

    public function afterAction($action, $result)
    {
        if($result) return $result;

        return $this->render($action->id, [
            'product' => Product::loadProduct(),
        ]);
    }
}
