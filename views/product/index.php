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
<?= $this->render('_table',[
    'products'  => $products,
    'pages'     => $pages,
    'my'        => false,
]);?>
