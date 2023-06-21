<?php

/** @var yii\web\View $this */


$this->title = Yii::$app->name;
?>

<!-- Banner -->
<?=  $this->render('_banner')?>

<!-- Characteristics -->
<?= $this->render('_characteristics')?>


<!-- Deals of the week -->
<?= $this->render('_deals_featured')?>


<!-- Popular Categories -->
<?= $this->render('_popular_categories')?>


<!-- Banner -->
<?= $this->render('_banner_2')?>


<!-- Hot New Arrivals -->
<?= $this->render('_new_arrivals')?>


<!-- Best Sellers -->
<?= $this->render('_best_sellers')?>


<!-- Adverts -->
<?= $this->render('_adverts')?>


<!-- Trends -->
<?= $this->render('_trends')?>


<!-- Reviews -->
<?= $this->render('_reviews')?>






