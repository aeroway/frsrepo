<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёт по звонкам';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="otchetlist-stat-index-tp">
    <p>Введите IP номер и необходимый диапазон дат</p>
    <div class="otchetlist-form-stat-tp">

        <?php $form = ActiveForm::begin(['action' => "/index.php?r=otchetlist/stat-index-tp", 'id' => 'stat-range-tp', 'method' => 'post',]); ?>

            <div class="form-group">
                <label for="phone">Тел.:</label>
                <input type="number" id="phone" name="phone" min="3009" max="5200" value="<?= empty($phone) ? '' : $phone ?>">
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
                <button type="submit" class="btn btn-success">Найти</button>
            </div>

        <?php ActiveForm::end(); ?>
        <?php if (!empty($result)) : ?>
            <?php echo $result; ?>
        <?php endif; ?>

    </div>
</div>