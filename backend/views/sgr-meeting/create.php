<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SgrMeeting */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Заседания', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgr-meeting-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
