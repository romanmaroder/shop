<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\DataProviderInterface */

/* @var $category core\entities\project\Category */

/* @var $brands core\entities\project\Brand */



$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;


 $this->render(
    '_list',
    [
        'dataProvider' => $dataProvider,
        'category'     => $category,
        'brands'       => $brands
    ]
);


