<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
//use yii\bootstrap\BaseHtml;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на получение правоустанавливающих документов';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php

$statusbutton = [
					'cstatus'=>function ($url, $model, $key)
					{
						$options = [
							'title' => Yii::t('yii', 'Сменить статус'),
							'aria-label' => Yii::t('yii', 'Status'),
							'data-toggle' => Yii::t('yii', 'modal'),
							'data-target' => Yii::t('yii', '#w0'),
						];
						$url=Yii::$app->getUrlManager()->createUrl(['req/createstatus','id'=>$model['id']]);

						return Html::a('<span class="glyphicon glyphicon-transfer"></span>', $url, $options);

					},
					'log'=>function ($url, $model)
					{
						$options = [
							'title' => Yii::t('yii', 'История'),
							'aria-label' => Yii::t('yii', 'История'),
						];
						$url=Yii::$app->getUrlManager()->createUrl(['req/log','logid'=>$model['id']]);
							return Html::a('<span class="glyphicon glyphicon-calendar"></span>', $url, $options);
					},
					'cdatereturn'=>function ($url, $model)
					{
						$options = [
							'title' => Yii::t('yii', 'Назначить дату возврата'),
							'aria-label' => Yii::t('yii', 'Назначить дату возврата'),
							'data-toggle' => Yii::t('yii', 'modal'),
							'data-target' => Yii::t('yii', '#w0'),
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
						$url=Yii::$app->getUrlManager()->createUrl(['req/createdatereturn','id'=>$model['id'], 'page'=>$page, 'sort'=>$sort]);
							return Html::a('<span class="glyphicon glyphicon-time"></span>', $url, $options);
					},
				];

if (in_array("alvl4", Yii::$app->user->identity->groups))
{
	$buttons = 	[
					'class' => 'yii\grid\ActionColumn',
					'buttons'=>$statusbutton,
					'template' => '{view} {update} {cstatus} {log}',
				];
}
elseif (in_array("alvl3", Yii::$app->user->identity->groups))
{
	$buttons =  [
					'class' => 'yii\grid\ActionColumn',
					'buttons'=>$statusbutton,
					'template' => '{view} {cstatus} {log} {cdatereturn}',
				];
}
elseif (in_array("alvl2", Yii::$app->user->identity->groups))
{
	$buttons =  [
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view}',
				];	
}
elseif (in_array("alvl1", Yii::$app->user->identity->groups))
{
	$buttons =  [
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view} {delete}',
				];
}
?>
<div class="req-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
			if(in_array("alvl1", Yii::$app->user->identity->groups)) {
				echo Html::a('Создать', ['create'], ['class' => 'btn btn-success']);
			}
		?>
    </p>

	<?php
	Modal::begin([
		'header' => '<h3>Сменить статус</h3>',
	]);
		ActiveForm::begin();
		echo '<div id="req-setup"></div>';
		ActiveForm::end();
	Modal::end();
	?>
<?php Pjax::begin(); ?>	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function($model)
		{
			if(date('Y-m-d',strtotime($model->date_return)) <= date('Y-m-d') and $model->date_return <> NULL) return ['class'=>'danger'];
		},
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
			[
				'attribute' => 'id',
				'contentOptions'=>['style'=>'text-align: center;width: 80px;'],
				//'contentOptions', 'headerOptions'
			],
			[
				//'attribute' => 'reqsReqSt.text',
				'attribute' => 'IconStatus',
				'label' => 'Статус',
				'format' => 'html',
				'value' => 'IconStatus',
				'contentOptions'=>['style'=>'text-align: center; width: 65px;'],
			],
			[
				//'attribute' => 'typesType.text',
				'attribute' => 'IconType',
				'label' => 'Материал',
				'format' => 'html',
				'value' => 'IconType',
				'contentOptions'=>['style'=>'text-align: center; width: 90px;'],
			],
			[
				//'attribute' => 'obj_addr',
				'attribute' => 'fullAddress',
				'label' => 'Адрес',
				'format' => 'html',
				'value' => 'fullAddress',
				'contentOptions' => ['style'=>'width: 200px;'],
			],
			[
				'attribute' => 'kn',
				'label' => 'Кадастровый №',
				'contentOptions' => ['style'=>'width: 180px;'],
			],
			[
				'attribute' => 'kuvd',
				'contentOptions' => ['style'=>'width: 190px;'],
			],
			[
				//'attribute' => 'zayavitel_fio',
				'attribute' => 'findOrg',
				'label' => 'Заявитель',
				'format' => 'html',
				'value' => 'findOrg',
				'contentOptions' => ['style'=>'width: 135px;'],
			],
			[
				'attribute' => 'user_text',
				'label' => 'Пользователь',
				'contentOptions'=>['style'=>'width: 130px;'],
			],
			//*Для кого 'user_to',
			/*[
				'attribute' => 'otdelsOtdel.text',
				'label' => 'Отдел',
			],*/
			[
				'attribute' => 'date_in',
				//'format' => ['raw', 'Y-m-d H:i:s'],
				'format' =>  ['date', 'php:d.m.Y H:i:s'],
				'contentOptions' => ['style'=>'width: 90px;'],
			],
			[
				'attribute' => 'cur_user',
				'contentOptions'=>['style'=>'width: 115px;'],
			],
			[
				'attribute' => 'user_print',
				'contentOptions'=>['style'=>'width: 115px;'],
			],
			[
				'attribute' => 'date_return',
				'label' => 'Возврат',
				'format' =>  ['date', 'php:d.m.Y'],
				'contentOptions' => ['style'=>'width: 90px;'],
			],
            // 'zayavitel_num',
            // 'obj_id',
            // 'kuvd_id',
            //'date_in',
            // 'coment',
            // 'cel',
            // 'date_end',
            // 'fast',
            // 'phone',
            // 'vedomost_num',
            // 'user_last',
            // 'vedomost_unform',
            // 'srok',
            // 'print_date',
            // 'code_mesto',
            // 'date_v',
            // 'area_id',
			// 'org',
			// 'inn',

			/*
			[
				'attribute' => 'areasArea.name',
				'label' => 'Район',
			],
			*/

			$buttons
			/* Стандартное отображение кнопок
            [
				'class' => 'yii\grid\ActionColumn',
				//'options'=>['style'=>'width: 50px;']
			],
			*/
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
