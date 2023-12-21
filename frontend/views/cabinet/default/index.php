<?php

/** @var yii\web\View $this */

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index mt-2">
    <div class="container">
        <div class='row'>
            <div class='col-12'><?= Breadcrumbs::widget(
                    [
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['class' => 'bg-white px-0'],
                    ]
                ) ?></div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="col-md-8 mb-2 mb-md-0 ">
                <p>Hello!</p>
                <p class="text-start">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore
                    magna aliqua. Id porta nibh venenatis cras sed. Elementum facilisis leo vel fringilla est. Nunc
                    consequat
                    interdum varius sit. Ullamcorper a lacus vestibulum sed arcu non odio. Pellentesque pulvinar
                    pellentesque
                    habitant morbi tristique senectus et. Nunc eget lorem dolor sed viverra. Diam donec adipiscing
                    tristique
                    risus nec feugiat in. Neque convallis a cras semper auctor neque vitae tempus. Id aliquet lectus
                    proin nibh
                    nisl. Rutrum tellus pellentesque eu tincidunt tortor.</p>
            </div>
            <div class="col-md-4 text-end border-start border-secondary">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li><a href="<?= Html::encode(
                                    Url::to(['/cabinet/wishlist/index'])
                                ); ?>">Wishlist</a></li>
                            <li><a href="">Item 1 </a></li>
                            <li><a href="">Item 2</a></li>
                            <li><a href="">Item 3</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <h2>Attach profile</h2>
                        <?= yii\authclient\widgets\AuthChoice::widget(
                            [
                                'baseAuthUrl' => ['cabinet/network/attach'],
                                'options' => [
                                ],

                            ]
                        ); ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>