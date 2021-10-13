<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёт за период в Excel';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="otchetlist-stat-index-otchet">
    <div class="otchetlist-form-stat-otchet">

        <?php $form = ActiveForm::begin([
                'action' => ['otchetlist/stat-index-otchet', 'tblname' => $tblname],
                'id' => 'stat-range-otchet',
                'method' => 'post',
            ]);
        ?>

            <div class="form-group">
                <input type="hidden" id="tblname" name="tblname" value="<?= empty($tblname) ? '' : $tblname ?>">
            </div>
            <div class="form-group">
                <label for="from">От:&nbsp;&nbsp;&nbsp;</label>
                <input type="date" id="fromDate" name="fromDate" value="<?= empty($fromDate) ? date("Y-m-d") : $fromDate ?>">
            </div>
            <div class="form-group">
                <label for="till">До:&nbsp;&nbsp;&nbsp;</label>
                <input type="date" id="tillDate" name="tillDate" value="<?= empty($tillDate) ? date("Y-m-d", strtotime("+1 day")) : $tillDate ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Скачать Excel</button>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>