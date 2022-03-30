<?php

use yii\helpers\Html;
use backend\models\Employee;

$this->title = 'Дни рождения сотрудников Росреестра КК';
$this->params['breadcrumbs'][] = ['label' => 'Главная', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-bthday-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $model = new Employee();
    echo $model->getBthday();
    ?>

</div>
