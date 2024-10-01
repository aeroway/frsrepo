<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SpartakiadRating $model */

$this->title = 'Create Spartakiad Rating';
$this->params['breadcrumbs'][] = ['label' => 'Spartakiad Ratings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spartakiad-rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
