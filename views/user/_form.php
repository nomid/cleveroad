<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $registerForm app\models\LoginForm */
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin([
    'id' => 'register-form',
    'action' => $action,
    'method' => $method,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

<?= $form->field($user, 'name') ?>
<?= $form->field($user, 'email') ?>
<?= $form->field($user, 'password')->passwordInput() ?>
<?= $form->field($user, 'repeat_password')->passwordInput() ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton($submit_title, ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
