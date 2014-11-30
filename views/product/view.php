<h2><?= $product->title ?></h2>
<ul>
    <li>image : <img src="<?= $product->getImage()->getUrl('150x'); ?>"></li>
    <li>created at : <?= $product->created_at ?></li>
    <li>created by : <?= $product->user->name ?></li>
    <li>price : <?= $product->price ?></li>
</ul>
