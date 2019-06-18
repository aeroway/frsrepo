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

        <?php $form = ActiveForm::begin(['action' => "/backend/index.php?r=otchetlist/stat-39-range&tblname=$tblname", 'id' => 'stat-39-range', 'method' => 'post',]); ?>

            <div>
                <label for="from">От</label>
                <input type="date" id="fromDate" name="fromDate"
                       value="<?= date("Y-m-d") ?>"
                       min="2018-09-01" max="2020-12-31">
            </div>
            <div>
                <label for="till">До</label>
                <input type="date" id="tillDate" name="tillDate"
                       value="<?= date("Y-m-d", strtotime("+1 day")) ?>"
                       min="2018-09-01" max="2020-12-31">
            </div>
            <?php if($tblname === 'otchet41' || $tblname === 'otchet42' || $tblname === 'otchet44' || $tblname === 'otchet47') : ?>
                <?= '
                <div>
                    <input type="text" id="username" name="username" placeholder="Пользователь" size="17">
                </div>
                '; ?>
            <?php endif; ?>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Найти</button>
            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>    