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
<div class="otchetlist-stat-index-ora">

    <p>Введите необходимый диапазон дат</p>

    <div class="otchetlist-form-ora">

        <?php $form = ActiveForm::begin(['action' => "/backend/index.php?r=otchetlist/stat-index-ora", 'id' => 'stat-ora-range', 'method' => 'post',]); ?>

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
            <div class="form-group">
                <button type="submit" class="btn btn-success">Найти</button>
            </div>

        <?php ActiveForm::end(); ?>

        <?php if (!empty($result)) : ?>
            <?php echo $result; ?>
        <?php endif; ?>
    </div>

</div>