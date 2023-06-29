<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category core\entities\project\Category */

use yii\helpers\Html;

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>


<?/*= $this->render('_subcategories', [
    'category' => $category
]) */?>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>
