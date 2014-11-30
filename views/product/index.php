<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(count($products)): ?>
<?= $this->render('_table',[
    'products'  => $products,
    'pages'     => $pages,
    'my'        => false,
]);?>
<?php else: ?>
    <p>No products :(</p>
    <p><a class="btn btn-lg btn-success" href="/product/new">Add products</a></p>
<?php endif; ?>