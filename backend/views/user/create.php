<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var core\entities\user\User $model */

$this->title                   = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='invoice p-3 mb-3'>
    <div class="user-create">

        <?= $this->render(
            '_form',
            [
                'model' => $model,
            ]
        ) ?>

    </div>
</div>
