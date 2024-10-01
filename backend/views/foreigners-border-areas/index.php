<?php

use backend\models\ForeignersBorderAreas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/** @var yii\web\View $this */
/** @var backend\models\ForeignersBorderAreasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Иностранцы приграничные территории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foreigners-border-areas-index">

    <h4>Сведения об общем количестве земельных участков, на которые зарегистрировано право собственности  иностранных физических и юридических лиц, лиц без гражданства, подпадающие под действие пункта 3 статьи 15 Земельного кодекса Российской Федерации и Указа Президента
Российской Федерации от 09.01.2011 №26 «Об утверждении перечня приграничных территорий, на которых иностранные граждане, лица без гражданства и иностранные юридические лица не могут обладать на праве собственности земельными участками» и предпринятых мерах</h4>
    <?php // echo Html::encode($this->title) ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p> </p>
    <?php
        $gridColumns = [
            'kn',
            'address',
            'permit_use',
            'num_reg',
            'date_reg:date',
            'date_term_right:date',
            'fio',
            'citizenship',
            'notice_ogv_oms',
            'notice_prosecutor',
            'sent_claims_ogv',
            'sent_claims_oms',
            'notice_interior_portal',
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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'kn',
            'address',
            'permit_use',
            'num_reg',
            'date_reg:date',
            'date_term_right:date',
            'fio',
            'citizenship',
            'notice_ogv_oms',
            'notice_prosecutor',
            'sent_claims_ogv',
            'sent_claims_oms',
            'notice_interior_portal',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ForeignersBorderAreas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
