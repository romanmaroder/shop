<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

?>
<?php
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name='viewport' content='width=device-width, initial-scale=1'/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
        <link href="<?= Yii::getAlias('@web/images/cart.png') ?>" rel="icon"/>
        <?php
        $this->head() ?>
    </head>
    <body>
    <?php
    $this->beginBody() ?>
    <div class='super_container'>

            <?= $this->render(
                '_header'
            ) ?>


        <?= $content ?>

        <!-- Footer -->

        <footer class='footer'>
            <div class='container'>
                <div class='row'>

                    <div class='col-lg-3 footer_col'>
                        <div class='footer_column footer_contact'>
                            <div class='logo_container'>
                                <div class='logo'><a href='#'>OneTech</a></div>
                            </div>
                            <div class='footer_title'>Got Question? Call Us 24/7</div>
                            <div class='footer_phone'>+38 068 005 3570</div>
                            <div class='footer_contact_text'>
                                <p>17 Princess Road, London</p>
                                <p>Grester London NW18JR, UK</p>
                            </div>
                            <div class='footer_social'>
                                <ul>
                                    <li><a href='#'><i class='fab fa-facebook-f'></i></a></li>
                                    <li><a href='#'><i class='fab fa-twitter'></i></a></li>
                                    <li><a href='#'><i class='fab fa-youtube'></i></a></li>
                                    <li><a href='#'><i class='fab fa-google'></i></a></li>
                                    <li><a href='#'><i class='fab fa-vimeo-v'></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class='col-lg-2 offset-lg-2'>
                        <div class='footer_column'>
                            <div class='footer_title'>Find it Fast</div>
                            <ul class='footer_list'>
                                <li><a href='#'>Computers & Laptops</a></li>
                                <li><a href='#'>Cameras & Photos</a></li>
                                <li><a href='#'>Hardware</a></li>
                                <li><a href='#'>Smartphones & Tablets</a></li>
                                <li><a href='#'>TV & Audio</a></li>
                            </ul>
                            <div class='footer_subtitle'>Gadgets</div>
                            <ul class='footer_list'>
                                <li><a href='#'>Car Electronics</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class='col-lg-2'>
                        <div class='footer_column'>
                            <ul class='footer_list footer_list_2'>
                                <li><a href='#'>Video Games & Consoles</a></li>
                                <li><a href='#'>Accessories</a></li>
                                <li><a href='#'>Cameras & Photos</a></li>
                                <li><a href='#'>Hardware</a></li>
                                <li><a href='#'>Computers & Laptops</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class='col-lg-2'>
                        <div class='footer_column'>
                            <div class='footer_title'>Customer Care</div>
                            <ul class='footer_list'>
                                <li><a href='#'>My Account</a></li>
                                <li><a href='#'>Order Tracking</a></li>
                                <li><a href='#'>Wish List</a></li>
                                <li><a href='#'>Customer Services</a></li>
                                <li><a href='#'>Returns / Exchange</a></li>
                                <li><a href='#'>FAQs</a></li>
                                <li><a href='#'>Product Support</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- Copyright -->

        <div class='copyright'>
            <div class='container'>
                <div class='row'>
                    <div class='col'>

                        <div class='copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start'>
                            <div class='copyright_content'>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
                                All rights reserved
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>
                            <div class='logos ml-sm-auto'>
                                <ul class='logos_list'>
                                    <li><a href='#'><img src=<?= Yii::getAlias(
                                                '@web/images/logos_1.png'
                                            ) ?> alt=''></a></li>
                                    <li><a href='#'><img src=<?= Yii::getAlias(
                                                '@web/images/logos_2.png'
                                            ) ?> alt=''></a></li>
                                    <li><a href='#'><img src=<?= Yii::getAlias(
                                                '@web/images/logos_3.png'
                                            ) ?> alt=''></a></li>
                                    <li><a href='#'><img src=<?= Yii::getAlias(
                                                '@web/images/logos_4.png'
                                            ) ?> alt=''></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage() ?>