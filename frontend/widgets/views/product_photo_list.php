<?php

/* @var $product core\entities\project\product\Product */
/* @var $limit frontend\widgets\ProductPhotoListWidget */

?>
<!-- Images -->
<div class='col-lg-2 order-lg-1 order-2'>
    <ul class='image_list'>
        <?php
        foreach ($product->photos as $i => $photo): ?>
            <?php if ($i < $limit ) :?>
                <li data-image='<?= $photo->getThumbFileUrl('file','catalog_origin') ?>'>
                    <a href='<?= $photo->getThumbFileUrl('file','catalog_product_main') ?>'>
                        <img src='<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>'
                             alt=''>
                    </a>
                </li>
            <?php endif ;?>
        <?php
        endforeach; ?>
    </ul>
</div>