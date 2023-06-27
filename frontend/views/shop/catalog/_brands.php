<?php
/* @var $brands core\entities\project\Brand */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php
if ($brands): ?>
    <div class='sidebar_section'>
        <div class='sidebar_subtitle brands_subtitle'>Brands</div>
        <ul class='brands_list'>
            <?php
            foreach ($brands as $brand): ?>
                <li class='brand'>
                    <a href='<?= Html::encode(Url::to(['brand', 'id' => $brand->id])) ?>'>
                        <?= Html::encode($brand->name) ?>
                    </a>
                </li>
            <?php
            endforeach; ?>
        </ul>
    </div>

<?php
endif; ?>