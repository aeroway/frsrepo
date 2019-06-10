<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EmplEcp */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ECP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empl-ecp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
		'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'attributes' => [
            //'id',
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
            'email',
        ],
    ]) ?>

</div>
