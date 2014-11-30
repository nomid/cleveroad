<?php
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Edit product';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'product' => $product,
        'action'  => '/products/'.$product->id,
        'method'  => 'put',
        'button_title' => 'Update',
    ]); ?>
</div>
