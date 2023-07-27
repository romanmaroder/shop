<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category core\entities\project\Category */

use yii\helpers\Html;

$this->title = $category->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $category->name;

$this->params['active_category'] = $category;
?>


<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>

