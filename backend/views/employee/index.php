<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'fam',
            'name',
            'otch',
			[
				'attribute' => 'idm_otdel',
				'label' => 'Отдел',
				'value' => 'otdelsName',
				// 'contentOptions' => ['style'=>'width: 15%;'],
			],
			[
				'attribute' => 'idm_doljn',
				'label' => 'Должность',
				'value' => 'doljnostName',
			],
            // 'pasp_s',
            //'pasp_n',
            //'pasp_date_v',
            //'pasp_kem_v',
            //'adres_f',
            //'adres_reg',
            //'date_priem',
            //'gsdp_y',
            //'gsdp_m',
            //'gsdp_d',
            //'otsdp_y',
            //'otsdp_m',
            //'otsdp_d',
            //'ver',
            //'is_top',
            //'date_nazn',
            //'idm_otdel',
            //'idm_doljn',
            //'oklad',
            //'nadbavka',
            //'osnovanie',
            //'date_in',
            //'brak',
            //'suprug',
            //'phone',
            //'prikazi',
            //'status',
            //'data_b',
            //'tgs_y',
            //'tgs_m',
            //'tgs_d',
            //'date_stazh',
            //'voen_uch',
            //'voen_kom',
            //'inn',
            //'snils',
            //'voen_zvanie',
            //'stat',
            //'gos_reg',
            //'gos_inspect',
            //'status_to',
            //'foto',
            //'tos_y',
            //'tos_m',
            //'tos_d',
            //'pol',
            //'doplata_ur_percent',
            //'doplata_ur_prikaz',
            //'doplata_ur_data',
            //'nadbavka_stazh',
            //'nadbavka_stazh_raschet',
            //'login_upr',
            //'login_just',
            //'check_is_login',
            //'skud_card_num',
            //'date_uvolnen',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' =>
                [
                    'exam-list' => function ($url, $model)
                    {
                        $url = Yii::$app->getUrlManager()->createUrl(['employee/exam-list', 'id' => $model['id']]);
                        $options = [
                            'title' => Yii::t('yii', 'Экзаменационный лист'),
                            'aria-label' => Yii::t('yii', 'examlist'),
                        ];

                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                    },
                ],
                'template' => '{exam-list}',
            ],
        ],
    ]); ?>


</div>
