<?php
/* @var $this yii\web\View */
$this->title = 'My Test Application';
?>
<div class="site-index">

    <div class="jumbotron">
    <?php if(Yii::$app->user->isGuest): ?>
        <p><a class="btn btn-lg btn-success" href="/login">Sign in!</a></p>
        <p><a class="btn btn-lg btn-success" href="/register">Or register</a></p>
    <?php else: ?>
        <p><a class="btn btn-lg btn-success" href="/products">Watch products</a></p>
        <p><a class="btn btn-lg btn-success" href="/product/new">Add products</a></p>
    <?php endif; ?>
    </div>
</div>
