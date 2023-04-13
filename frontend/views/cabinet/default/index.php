<?php

/** @var yii\web\View $this */

use yii\bootstrap4\Html;

$this->title                   = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-8 mb-2 mb-md-0 ">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Hello!</p>
    </div>
    <div class="col-md-4 text-end border-start border-secondary">
        <h2>Attach profile</h2>
        <?= yii\authclient\widgets\AuthChoice::widget(
            [
                'baseAuthUrl' => ['cabinet/network/attach'],
                'options'     => [
                    'class' => 'd-flex flex-column align-items-end '
                ],

            ]
        ); ?>
        <p class="text-start">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
           magna aliqua. Id porta nibh venenatis cras sed. Elementum facilisis leo vel fringilla est. Nunc consequat
           interdum varius sit. Ullamcorper a lacus vestibulum sed arcu non odio. Pellentesque pulvinar pellentesque
           habitant morbi tristique senectus et. Nunc eget lorem dolor sed viverra. Diam donec adipiscing tristique
           risus nec feugiat in. Neque convallis a cras semper auctor neque vitae tempus. Id aliquet lectus proin nibh
           nisl. Rutrum tellus pellentesque eu tincidunt tortor.</p>
    </div>
</div>
<div class="cabinet-index">


</div>