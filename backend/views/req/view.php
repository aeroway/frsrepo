<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Req */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
            $update = Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            $delete = Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить данную запись?',
                    'method' => 'post',
                ],
            ]);

            if (in_array("alvl4", Yii::$app->user->identity->groups))
            {
                echo $update;
            }
            elseif (in_array("alvl3", Yii::$app->user->identity->groups))
            {
                // ничего
            }
            elseif (in_array("alvl2", Yii::$app->user->identity->groups))
            {
                // ничего
            }
            elseif (in_array("alvl1", Yii::$app->user->identity->groups))
            {
                echo $delete;
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'otdelsOtdel.text',
                'label' => 'Отдел',
            ],
            [
                'attribute' => 'typesType.text',
                'label' => 'Архивный материал',
            ],
            [
                'attribute' => 'celsCel.text',
                'label' => 'Цель',
            ],
            'zayavitel_fio',
            'obj_addr',
            'kn',
            'kuvd',
            'user_text',
            'user_to',
            //'fast',
            [
                'attribute' => 'fast',
                'format'=>'raw',
                'value' => $model->fast ? 'Срочная' : 'Обычная',
            ],
            'scan_doc',
            //'id',
            //'zayavitel_num',
            //'obj_id',
            //'kuvd_id',
            //'status',
            //'date_in',
            //'coment',
            //'cur_user',
            //'date_end',
            'phone',
            //'vedomost_num',
            //'user_last',
            //'vedomost_unform',
            //'srok',
            //'user_print',
            //'print_date',
            //'code_mesto',
            //'date_v',
            //'area_id',
            //'org',
            //'inn',
        ],
    ]) ?>

</div>
