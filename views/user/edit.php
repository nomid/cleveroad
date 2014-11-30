<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $registerForm app\models\LoginForm */

$this->title = 'Edit profile';
$this->params['breadcrumbs'][] = $this->title;
$user->password = '';
?>
<div class="site-login">
    <?= $this->render('_form',[
        'user' => $user,
        'method' => 'put',
        'action' => '/users/'.$user->id,
        'submit_title' => 'Update profile',
    ]);?>

</div>
