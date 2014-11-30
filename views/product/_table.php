<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<table class="table">
    <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Created at</th>
        <th>Price</th>
    <?php if($my): ?>
        <th>Action</th>
    <?php else: ?>
        <th>Email</th>
    <?php endif; ?>

    </tr>
<?php foreach($products as $product):?>
    <tr>
        <td><?php if($product->image):?>
            <img src="<?= $product->getImage()->getUrl('80x'); ?>">
            <?php else: ?>
            no image
            <?php endif; ?>
        </td>
        <td><?= $product->title?></td>
        <td><?= date('d.m.Y', $product->created_at)?></td>
        <td><?= $product->price?></td>
    <?php if($my): ?>
        <td><a href="/products/<?= $product->id; ?>/edit">Edit</a>/
            <a data-method="delete" href="/products/<?= $product->id; ?>">Delete</a></td>
    <?php else: ?>
        <td><a href="/users/<?= $product->user->id; ?>"><?= $product->user->email; ?></a></td>
    <?php endif; ?>

    </tr>
<?php endforeach; ?>
</table>
<?php
echo LinkPager::widget([
    'pagination' => $pages,
]);
?>