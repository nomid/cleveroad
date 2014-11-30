<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $registerForm app\models\LoginForm */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <?= $this->render('_form',[
        'user'          => $user,
        'method'        => 'post',
        'action'        => '/users',
        'submit_title'  => 'Register',
    ]);?>

</div>
