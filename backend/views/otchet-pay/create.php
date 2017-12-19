<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OtchetPay */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Otchet Pays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchet-pay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
