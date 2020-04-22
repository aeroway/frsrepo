<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\VupiskiDogovor */

$this->title = 'Create Vupiski Dogovor';
$this->params['breadcrumbs'][] = ['label' => 'Vupiski Dogovors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vupiski-dogovor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
