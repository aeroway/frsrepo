<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\PurchasePlan;
use backend\models\SchedulePlan;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SchedulePlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Смета', 'url' => ['spending/index']];
$this->params['breadcrumbs'][] = ['label' => 'План закупок', 'url' => ['purchaseplan/index', 'id' => $id]];
$this->title = 'План график';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать план график', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Способ закупки', Yii::$app->getUrlManager()->createUrl(['purchasemethod/index']), ['class' => 'btn btn-info']) ?>
        <?= Html::a('Лимит БО', Yii::$app->getUrlManager()->createUrl(['lbo/index']), ['class' => 'btn btn-info']) ?>
        <?= Html::a('Расходы', Yii::$app->getUrlManager()->createUrl(['spending/index']), ['class' => 'btn btn-info']) ?>

        <?php
        $ppbody = '<div style="height: 120px;"><div style="width: 50%; float: left;">';
        $pp2body = '<div style="width: 50%; float: right;">';

        
        foreach(PurchasePlan::find()->where(['id' => $id])->asArray()->one() as $key => $value)
        {
            if($key == 'okpd' and !empty($value))
                $ppbody .= '<b>ОКПД:</b> ' . $value . '<br>';
            if($key == 'name_object' and !empty($value))
                $ppbody .= '<b>Название:</b> ' . $value . '<br>';
            if($key == 'outlay' and !empty($value))
                $ppbody .= '<b>Смета:</b> ' . $value . '<br>';
            if($key == 'p_year' and !empty($value))
                $ppbody .= '<b>Предыдущий год:</b> ' . $value . '<br>';
            if($key == 'c_year' and !empty($value))
                $ppbody .= '<b>Текущий год:</b> ' . $value . '<br>';
            if($key == 'special' and !empty($value))
                $ppbody .= '<b>Особые закупки:</b> ' . $value . '<br>';
            if($key == 'sum' and !empty($value))
                $ppbody .= '<b>Всего:</b> ' . $value . '<br>';
            if($key == 'year' and !empty($value))
                $ppbody .= '<b>Год ПЗ:</b> ' . $value . '<br>';
        }
        $ppbody .= '</div>';

        $pp2body .= '<b>Планируемая сумма (всего):</b> ' . SchedulePlan::find()->select('SUM(sum) as sum')->from('schedule_plan')->where(['pp_id' => $id])->one()["sum"] . '<br>' .
                    '<b>Фактическая сумма (всего): </b> ' . SchedulePlan::find()->select('SUM(sum_fact) as sum_fact')->from('schedule_plan')->where(['pp_id' => $id])->one()["sum_fact"] . '<br>' .
                    '<b>Экономия: </b> ' . (SchedulePlan::find()->select('SUM(sum) as sum')->from('schedule_plan')->where(['pp_id' => $id])->one()["sum"] - 
                    SchedulePlan::find()->select('SUM(sum_fact) as sum_fact')->from('schedule_plan')->where(['pp_id' => $id])->one()["sum_fact"]) .

        '</div></div>';

        echo Alert::widget([
            'options' => [
                'class' => 'alert-info'
            ],
            'body' => $ppbody . $pp2body
        ]);
        ?>
    </p>
<?php
    $button =
    [
        'class' => 'yii\grid\ActionColumn',
        'buttons'=>
        [
            'update'=>function ($url, $model, $key)
            {
                $options = [
                    'title' => Yii::t('yii', 'Редактировать'),
                    'aria-label' => Yii::t('yii', 'Редактировать'),
                ];

                if(empty(Yii::$app->request->queryParams["page"])) {
                    $page = 1;
                } else {
                    $page = Yii::$app->request->queryParams["page"];
                }
                if(empty(Yii::$app->request->queryParams["sort"])) {
                    $sort = '';
                } else {
                    $sort = Yii::$app->request->queryParams["sort"];
                }

                $url=Yii::$app->getUrlManager()->createUrl(['scheduleplan/update','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);

                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            }
        ],
        'template'=>'{view} {update}',
    ];
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'sum',
            'comment',
            [
                'attribute'=>'pm_id',
                'value'=>'pm.name',
            ],
            'sum_fact',
            'sum_contract',
            [
                'value' => 'sumAllField',
                'format' => 'html'
            ],
            //'name_doc',
            //'date_doc',
            //'date_exp_from',
            //'date_exp_to',
            //'inn',
            //'name_org',

            //['class' => 'yii\grid\ActionColumn'],
            $button,
        ],
    ]); ?>
</div>
