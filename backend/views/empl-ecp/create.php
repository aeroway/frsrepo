<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EmplEcp */

$this->title = 'Создать ECP';
$this->params['breadcrumbs'][] = ['label' => 'ECP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empl-ecp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
