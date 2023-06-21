<?php

use yii\helpers\Html;

?>


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
