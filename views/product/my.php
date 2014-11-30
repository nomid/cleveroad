<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\helpers\BaseUrl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My products';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_table',[
    'products'  => $products,
    'pages'     => $pages,
    'my'        => true,
]);?>