<?php

/* @var $category core\entities\project\Category */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if ($category->children): ?>
    <!-- Shop Sidebar -->
    <div class='sidebar_section'>
        <div class='sidebar_title'>Categories</div>
        <ul class='sidebar_categories'>
            <?php
            foreach ($category->children as $child): ?>
                <li><a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>">
                        <?= Html::encode($child->name) ?>
                    </a>
                </li>
            <?php
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>