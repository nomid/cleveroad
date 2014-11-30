<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\BaseUrl;
use yii\bootstrap\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <base href="<?= BaseUrl::base(true); ?>">
    <?php $this->head() ?>
</head>
<body>


<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            $user = Yii::$app->user;
            NavBar::begin([
                'brandLabel' => 'Cleveroad',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $nav = [
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/']],
                ]
            ];
            if($user->isGuest){
                $nav['items'][] = ['label' => 'Login', 'url' => ['/login']];
                $nav['items'][] = ['label' => 'Register', 'url' => ['/register']];
            }
            else{
                $nav['items'][] = ['label' => 'Logout (' . $user->identity->name . ')',
                    'url' => ['/logout'],
                    'linkOptions' => ['data-method' => 'delete']];
                $nav['items'][] = [
                    'label' => 'menu',
                    'items' => [
                        ['label' => 'Profile', 'url' => '/users/'.$user->id.'/edit'],
                        ['label' => 'Add product', 'url' => '/product/new'],
                        ['label' => 'My products', 'url' => '/products/my'],
                    ]
                ];
            }
            echo Nav::widget($nav);
            NavBar::end();
        ?>

        <div class="container">
            <?php
            foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-'.$key,
                    ],
                    'body' => $message,
                ]);
            }
            ?>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
