<?php

use yii\helpers\Html;
use backend\models\EmplEcp;

$this->title = 'Срок действия ЭЦП окончен, либо истекает через 2 месяца';
$this->params['breadcrumbs'][] = ['label' => 'ECP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empl-ecp-stat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $model = new EmplEcp();
    echo $model->getEcpStopCount();
    ?>

</div>
