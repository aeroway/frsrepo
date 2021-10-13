<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$this->title = 'Результаты тестирования';
$this->params['breadcrumbs'][] = ['label' => 'Раздел тестов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
tbody tr:nth-child(1) {
    color: green; /* Цвет текста */
    font-weight: bold;
}
</style>
<div class="testing-result-section">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> </p>
    <?php
        $gridColumns = [
            'date_in',
            'fio',
            'pr'
        ];

        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            // 'target' => ExportMenu::TARGET_SELF,
            // 'showConfirmAlert' => false,
            // 'showColumnSelector' => false,
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
            ],
            'filename' => 'exported-data_' . date('Y-m-d_H-i-s'),
        ]);
    ?>
    <p> </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'date_in',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate(substr($model->date_in, 0, 11), 'dd.MM.yyyy');
                }
            ],
            'fio',
            'pr',
        ],
    ]); ?>

</div>
