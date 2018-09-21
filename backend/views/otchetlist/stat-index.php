<?php

use yii\widgets\ActiveForm;
//use yii\helpers\Html;

//use backend\models\Otchetlist;
//use backend\models\Otchett;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="otchetlist-stat-index">

    <p>Введите необходимый диапазон дат</p>

    <div class="otchetlist-form">

        <?php $form = ActiveForm::begin(['action' => '/backend/index.php?r=otchetlist/stat-39-range&tblname=otchet39', 'id' => 'stat-39-range', 'method' => 'post',]); ?>

            <div>
                <label for="from">От</label>
                <input type="date" id="fromDate" name="fromDate"
                       value="2018-08-27"
                       min="2018-07-01" max="2018-12-31">
            </div>
            <div>
                <label for="till">До</label>
                <input type="date" id="tillDate" name="tillDate"
                       value="2018-08-31"
                       min="2018-07-01" max="2018-12-31">
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Найти</button>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>    