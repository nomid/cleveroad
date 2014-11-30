<?php
use yii\helpers\BaseUrl;
?>
<h2>Thank you for register</h2>
<a href="<?= BaseUrl::base(true); ?>/user/activate?hash=<?= $hash; ?>">Activation link</a>