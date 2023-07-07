<?php
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Breadcrumbs;

?>

<div class='col-lg-9'>

    <!-- Shop Content -->
    <div class='shop_content'>
        <div class='shop_bar clearfix'>
            <div class='row'>
                <div class='col-12'><?= Breadcrumbs::widget(
                        [
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => 'bg-white px-0'],
                        ]
                    ) ?></div>
            </div>
            <div class='shop_product_count'><span><?= $dataProvider->getTotalCount() ?></span> products found</div>
            <div class='shop_sorting'>
                <span>Sort by:</span>
                <ul>
                    <li>
                        <span class='sorting_text'>highest rated<i class='fas fa-chevron-down'></i></span>
                        <?php
                        $values = [
                            'original-order' => 'highest rated',
                            'name' => 'name',
                            'price' => 'price',
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
        <div class='product_grid'>
            <?php if ($dataProvider->getModels()): ?>
                <?php
                foreach ($dataProvider->getModels() as $product): ?>
                    <?= $this->render(
                        '_product',
                        [
                            'product' => $product
                        ]
                    ) ?>
                <?php
                endforeach; ?>
        </div>

        <!-- Shop Page Navigation -->

        <div class='shop_page_nav d-flex flex-row justify-content-center'>
            <?= LinkPager::widget(
                [
                    'pagination' => $dataProvider->getPagination(),
                    'listOptions' => [
                        'class' => 'page_nav d-flex flex-row',
                    ],
                    'linkOptions' => [],
                    'linkContainerOptions' => [],
                    'prevPageCssClass' => 'page_prev mr-3 d-flex flex-column align-items-center justify-content-center',
                    'nextPageCssClass' => 'page_next ml-3 d-flex flex-column align-items-center justify-content-center',
                    'prevPageLabel' => '<i class=\'fas fa-chevron-left\'></i>',
                    'nextPageLabel' => '<i class=\'fas fa-chevron-right\'></i>',
                    'hideOnSinglePage' => false,

                ]
            ) ?>
        </div>
        <div class='text-center mt-3'>Showing <?= $dataProvider->getCount() ?>
            of <?= $dataProvider->getTotalCount() ?></div>

        <?php else :?>
            <div class='single_product'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-12'><h2 class="text-center my-5">No products found</h2></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>
