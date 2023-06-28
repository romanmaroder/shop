<?php
/* @var $dataProvider yii\data\DataProviderInterface */
?>

<div class='shop_bar clearfix'>
    <div class='shop_product_count'><span><?= $dataProvider->getTotalCount(
            ) ?></span> products found</div>
    <div class='shop_sorting'>
        <span>Sort by:</span>
        <ul>
            <li>
                <span class='sorting_text'>highest rated<i class='fas fa-chevron-down'></i></span>
                <?php
                $values  = [
                    'original-order' => 'highest rated',
                    'name'           => 'name',
                    'price'          => 'price',
                ];
                $current = Yii::$app->request->get('sortBy');
                ?>
                <?php
                /*foreach ($values as $value => $label): */ ?><!--
                                        <option value="<?
                /*= Html::encode(Url::current(['sort' => $value ?: null])) */ ?>"
                                        <?php
                /*if ($current == $value): */ ?>selected="selected"<?php
                /*endif; */ ?>><?
                /*= $label */ ?></option>
                                    --><?php
                /*endforeach; */ ?>
                <ul>
                    <?php
                    foreach ($values as $value => $label) : ?>

                        <li class='shop_sorting_button'
                            data-isotope-option='{ "sortBy": "<?= $value ?>" }'><?= $label ?>
                        </li>

                    <?php
                    endforeach; ?>
                </ul>
            </li>
        </ul>
    </div>
</div>
