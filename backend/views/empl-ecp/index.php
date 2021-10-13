<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use backend\models\EmplEcpStatus;
use backend\models\EmplEcpOrg;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmplEcpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ECP';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if (!in_array("EcpAdmin", Yii::$app->user->identity->groups))
{
	$buttons = 	[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view} {update}',
				];
}
else
{
	$buttons =  [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons'=>
                    [
                        'log' => function ($url, $model)
                        {
                            $options = [
                                'title' => Yii::t('yii', 'История'),
                                'aria-label' => Yii::t('yii', 'История'),
                            ];
                            $customurl = Yii::$app->getUrlManager()->createUrl(['empl-ecp/log', 'ecpid' => $model['id']]);
                                return Html::a('<span class="glyphicon glyphicon-calendar"></span>', $customurl, $options);
                        },
                    ],
                    'template' => '{view} {update} {delete} {log}',
                ];
}
?>
<div class="empl-ecp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
		if(in_array("EcpAdmin", Yii::$app->user->identity->groups)) {
			echo Html::a('Создать ECP', ['create'], ['class' => 'btn btn-success']);
		}
		?>
        <?= Html::a('Статистика', ['stat'], ['class' => 'btn btn-info']) ?>
    </p>

    <p> </p>
    <?php
        $gridColumns = [
            'fullName',
			'otdels',
            'ecp_stop',
            //'EcpOrgName',
            'Statustxt',
            'email'
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
		'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'rowOptions' => function($model)
        {
			if(date('Y-m-d', strtotime($model->ecp_stop)) <= date('Y-m-d', strtotime("+60 days")) && !empty($model->ecp_stop)) return ['class' => 'danger'];
			if ($model->employeesEmployee->status == 2) return ['class' => 'warning'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'idm_empl',
			[
				//'attribute' => 'obj_addr',
				'attribute' => 'fullName',
				'label' => 'ФИО',
				//'format' => 'html',
				'value' => 'fullName',
				//'contentOptions' => ['style'=>'width: 150px;'],
			],
			// [
			// 	'attribute' => 'doljnost',
			// 	'label' => 'Должность',
			// 	'value' => 'doljnost',
			// ],
			[
				'attribute' => 'otdels',
				'label' => 'Отдел',
				'value' => 'otdels',
				'contentOptions' => ['style'=>'width: 15%;'],
			],
			[
				'attribute' => 'ecp_org_id',
				'label' => 'УЦ',
				'value' => 'EcpOrgName',
				'contentOptions' => ['style'=>'width: 80px; text-align: center;'],
				'filter' => ArrayHelper::map(EmplEcpOrg::find()->asArray()->all(), 'text', 'text'),
			],
			// [
			// 	'attribute' => 'ecp_start',
			// 	'format' =>  ['date', 'php:d.m.Y'],
			// 	'label' => 'Выдано',
			// 	'contentOptions' => ['style'=>'width: 90px; text-align: center;'],
			// ],
			[
				'attribute' => 'ecp_stop',
				'format' =>  ['date', 'php:d.m.Y'],
				'label' => 'Окончание',
				'contentOptions' => ['style'=>'width: 90px; text-align: center;'],
                'value' => 'ecp_stop',
			],
			[
				'attribute' => 'ecpmodify_date',
				'format' =>  ['date', 'php:d.m.Y'],
				'label' => 'Модификация',
				'contentOptions' => ['style'=>'width: 90px; text-align: center;'],
			],
            //'ecp_org_id',
            //'status',
			// [
			// 	'attribute' => 'nositel_num',
			// 	'label' => '№ носителя',
			// 	'contentOptions' => ['style'=>'width: 10%; text-align: center;'],
			// ],
			// [
			// 	'attribute' => 'invent_num',
			// 	'contentOptions' => ['style'=>'width: 10%;'],
			// ],
			'username',
			[
				'attribute' => 'Statustxt',
				'label' => 'Статус',
				'value' => 'Statustxt',
				'contentOptions' => ['style'=>'width: 5%;'],
				'filter'=>ArrayHelper::map(EmplEcpStatus::find()->asArray()->all(), 'text', 'text'),
			],
            'comment_ecp',
            //'nositel_type',
            //'date_in',
            //'req_date',
            //'user_in',
            'email',

            $buttons,
        ],
    ]); ?>

</div>
