<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\EmplEcp */

$this->title = 'История изменений';
$this->params['breadcrumbs'][] = ['label' => 'ECP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
tbody tr:nth-child(1) {
    color: green; /* Цвет текста */
    font-weight: bold;
}
</style>
<div class="empl-ecp-log">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				//'attribute' => 'idm_empl',
				'attribute' => 'FullName',
				'label' => 'ФИО',
			],
			[
				'attribute' => 'doljnost',
				'label' => 'Должность',
			],
			[
				'attribute' => 'otdels',
				'label' => 'Отдел',
			],
			[
				'attribute' => 'EcpOrgName',
				'label' => 'УЦ',
			],
			[
				'attribute' => 'ecp_start',
				'format' =>  ['date', 'php:d.m.Y'],
			],
			[
				'attribute' => 'ecp_stop',
				'format' =>  ['date', 'php:d.m.Y'],
			],
            'nositel_num',
			'invent_num',
			[
				'attribute' => 'Statustxt',
				'label' => 'Статус',
			],
            'comment_ecp',
			[
				'attribute' => 'ecpmodify_date',
				'format' =>  ['date', 'php:d.m.Y'],
			],
            //'nositel_type',
            //'date_in',
            //'req_date',
            //'user_in',
        ],
    ]); ?>

</div>
