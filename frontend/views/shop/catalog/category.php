<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\DataProviderInterface */

/* @var $category core\entities\project\Category */

/* @var $brands core\entities\project\Brand */


$this->title = $category->getSeoTitle();

$this->registerMetaTag(['name' => 'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $category->name;
?>


<?= $this->render(
    '_list',
    [
        'dataProvider' => $dataProvider,
        'category'     => $category,
        'brands'       => $brands
    ]
) ?>


