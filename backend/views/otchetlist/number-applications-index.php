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

<div class="otchetlist-number-applications-index">
    <p>Введите необходимый диапазон дат</p>
    <div class="otchetlist-form-number-applications-index">

        <?php $form = ActiveForm::begin(['action' => "/index.php?r=otchetlist/number-applications", 'id' => 'number-range-applications', 'method' => 'post',]); ?>

            <div class="form-group">
                <label for="from">От:&nbsp;&nbsp;&nbsp;</label>
                <input type="date" id="fromDate" name="fromDate" value="<?= empty($fromDate) ? date("Y-m-d") : $fromDate ?>">
            </div>
            <div class="form-group">
                <label for="till">До:&nbsp;&nbsp;&nbsp;</label>
                <input type="date" id="tillDate" name="tillDate" value="<?= empty($tillDate) ? date("Y-m-d", strtotime("+1 day")) : $tillDate ?>">
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