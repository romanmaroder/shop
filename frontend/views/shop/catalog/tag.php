<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $tag core\entities\project\Tag */

use yii\helpers\Html;

$this->title = 'Products with tag ' . $tag->name;

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;

?>


<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>