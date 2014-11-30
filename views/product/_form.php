<?php
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'id' => 'new-product-form',
    'action' => $action,
    'method' => $method,
    'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',
    ],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>

<?= $form->field($product, 'title') ?>
<?= $form->field($product, 'price') ?>
<?php if($product->getImage()): ?>
    <img src="<?= $product->getImage()->getUrl('150x'); ?>"><br>
    Change image: <br>
<? endif; ?>
<?= $form->field($product, 'image')->fileInput() ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton($button_title, ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>