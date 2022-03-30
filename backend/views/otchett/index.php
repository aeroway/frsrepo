<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use backend\models\Otchett;
use yii\helpers\ArrayHelper;
use backend\models\Employee;
use backend\models\AreaOtchet;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$otchett = new Otchett();

$this->title = 'Отчёт: ' . $otchett->otchetList(Otchett::$name);
$this->params['breadcrumbs'][] = $this->title;

if(Otchett::$name == 'otchet29')
    echo Alert::widget([
        'options' => [
            'class' => 'alert-info'
        ],
        'body' => '<h4>Слева площадь ЕГРП. Справа площадь ГКН.</h4>'
    ]);
?>
<div class="otchet-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Yii::$app->session->setFlash('table', Otchett::$name); ?>

    <p>
        <?php if (Otchett::$name == 'otchet67'): ?>
            <?php echo Html::a('Добавить запись', ['create', 'table' => Otchett::$name], ['class' => 'btn btn-success']); ?>
        <?php endif; ?>
    </p>

    <?=Html::beginForm(['otchett/bulk'],'post');?>
    <?php
    if(in_array("OtchetManager", Yii::$app->user->identity->groups))
    {
        $arrayUsers = ArrayHelper::map(Employee::find()
            ->where(['and', ['or', ['idm_otdel' => 139], ['idm_otdel' => 3], ['idm_otdel' => 170]], ['status' => 1]])
            ->orderBy(['fam' => SORT_ASC])
            ->all(), 'fullName', 'fullName');

        $arrayArea = ArrayHelper::map(AreaOtchet::find()
            ->orderBy(['name' => SORT_ASC])
            ->where(['<>', 'name_2', NULL])
            ->all(), 'name_2', 'name_2');

        $arrayMergeList = ArrayHelper::merge($arrayUsers, $arrayArea);

        $arrayMergeList["1"] = "Выберите пользователя";

        echo Html::dropDownList('action', '1', $arrayMergeList, [
            'class' => 'form-control', 
            'style' => 'width: 20%; margin-bottom: 10px; margin-right: 10px; float: left'
        ]);

        echo Html::submitButton('Назначить', ['class' => 'btn btn-info', 'style' => 'margin-bottom: 10px;']);
    }
    ?>

    <?php
    $username = [
        'attribute' => 'username',
        'contentOptions' => ['style'=>'width: 150px;'],
    ];
    $date_load = [
        'attribute' => 'date_load',
        'format' =>  ['date', 'php:d M Y'],
        'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
    ];
    $flag = 'flag';
    $area = 'area';
    $date = [
        'attribute' => 'date',
        'format' =>  ['date', 'php:d M Y'],
        'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
    ];
    ?>

    <?php if (Otchett::$name === 'otchet56') : ?>
        <?php $labelDescription = ['label' => 'Площадь №1', 'attribute' => 'description',]; ?>
        <?php $labelComment = 'Площадь №2'; ?>
        <?php $labelKn = 'КН/УН'; ?>
    <?php elseif (Otchett::$name === 'otchet63') : ?>
        <?php $labelDescription = ['label' => 'Дата постановки на учёт', 'attribute' => 'description',]; ?>
        <?php $labelComment = 'Дата снятия'; ?>
        <?php $labelKn = 'КН/УН'; ?>
    <?php elseif (Otchett::$name === 'otchet67') : ?>
        <?php $labelDescription = ['label' => 'Тип обращения', 'attribute' => 'description',]; ?>
        <?php $labelComment = 'Доп. информация'; ?>
        <?php $labelKn = 'Номер обращения'; ?>
    <?php elseif (Otchett::$name === 'otchet84') : ?>
        <?php $labelComment = 'ДОЛЖНО БЫТЬ'; ?>
        <?php $labelDescription = ['label' => 'ФИО и ДР', 'attribute' => 'description',]; ?>
        <?php $labelKn = 'КН/УН'; ?>
    <?php elseif (Otchett::$name === 'otchet110') : ?>
        <?php $labelComment = NULL; ?>
        <?php $labelDescription = ['label' => 'Адрес', 'attribute' => 'description',]; ?>
        <?php $labelKn = 'КН/УН'; ?>
    <?php elseif (Otchett::$name === 'otchet78') : ?>
        <?php $labelDescription = ['label' => 'КН ед. зем.польз.', 'attribute' => 'description',]; ?>
        <?php $labelComment = 'Документ основания'; ?>
        <?php $labelKn = 'КН'; ?>
        <?php $labelArea = 'Документ в СЭД'; ?>
    <?php else: ?>
        <?php $labelDescription = ['label' => 'Описание', 'attribute' => 'description',]; ?>
        <?php $labelComment = 'Наимен. ошибки'; ?>
        <?php $labelKn = 'КН/УН'; ?>
    <?php endif; ?>

    <?php if (Otchett::$name === 'otchet41' || Otchett::$name === 'otchet42'|| Otchett::$name === 'otchet44') : ?>
        <?php $labelProtocol = ['label' => 'Результат', 'attribute' => 'protocol',]; ?>
    <?php elseif (Otchett::$name === 'otchet63') : ?>
        <?php $labelProtocol = ['label' => 'Основание снятия в ГКН', 'attribute' => 'protocol',]; ?>
    <?php elseif (Otchett::$name === 'otchet78') : ?>
        <?php $labelProtocol = ['label' => 'Примечание', 'attribute' => 'protocol',]; ?>
    <?php else: ?>
        <?php $labelProtocol = ['label' => 'Протокол', 'attribute' => 'protocol',]; ?>
    <?php endif; ?>

    <?php if (Otchett::$name === 'otchet67') : ?>
        <?php $status = []; ?>
        <?php $comment = []; ?>


    <?php elseif (Otchett::$name === 'otchet110') : ?>
        <?php 
            $status = [
                //'label' => $labelComment,
                'attribute' => 'status',
            ];
            $comment = [
                //'label' => $labelComment,
                //'attribute' => 'comment',
            ];
            $area = [];
        ?>
        <?php $status =
            [
                'label' => 'Статус',
                'attribute' => 'status',
                'value' => 'status',
                'filter' => ArrayHelper::map(Otchett::find()->asArray()->all(), 'status', 'status'),
            ];
        ?>
        <?php
            $labelProtocol = [
                'label' => 'Примечание',
                'attribute' => 'protocol',
            ];
        ?>

    <?php elseif (Otchett::$name === 'otchet78') : ?>
        <?php $username = []; ?>
        <?php $status = []; ?>
        <?php 
            $comment = [
                'label' => $labelComment,
                'attribute' => 'comment',
            ];
        ?>
        <?php $date = []; ?>
        <?php $area = [
                'label' => $labelArea,
                'attribute' => 'area',
                // 'format' => 'html',
                // 'contentOptions' => [
                //     'style' => 'min-width: 180px; overflow: auto; white-space: normal; word-wrap: break-word;'
                // ],
        ]; ?>
        <?php // $flag = []; ?>
        <?php $date_load = []; ?>
    <?php else: ?>
        <?php $status =
            [
                'attribute' => 'status',
                'value' => 'status',
                'filter' => ArrayHelper::map(Otchett::find()->asArray()->all(), 'status', 'status'),
            ];
        ?>
        <?php $comment =
            [
                'label' => $labelComment,
                'attribute' => 'comment',
                'value' => function($data) {
                    if (Otchett::$name == 'otchet39' || Otchett::$name == 'otchet46') {
                        return date('d.m.Y', strtotime($data->comment));
                    } else {
                        return $data->comment;
                    }
                },
                'format' => 'raw',
            ];
        ?>
    <?php endif; ?>

    <p> </p>
    <?php
        $gridColumns = [
            'kn',
            'description',
            'comment',
            'username',
            'protocol',
            'date',
            'area',
            'flag',
            'status',
            'date_load'
            // 'id_dpt',
            // 'id_egrp'
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
        'rowOptions' => function($model)
        {
            if(isset($model->control) and $model->control == 1) return ['class'=>'warning'];
            if($model->flag == 1) return ['class'=>'danger'];
            if($model->flag == 2) return ['class'=>'success'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],

            //'id',
            [
                'label' => $labelKn,
                'attribute' => 'kn',
                'contentOptions' => ['style'=>'width: 160px;'],
            ],
            $labelDescription,
            $status,
            $comment,
            $date,
            $username,
            $flag,
            //'id_dpt',
            //'id_egrp',
            /*
            [
                'attribute' => 'date_update',
                'format' =>  ['date', 'php:M d Y'],
                'contentOptions' => ['style'=>'width: 120px; text-align: center;'],
            ],
            */
            //'filename',
            $date_load,
            $area,
            $labelProtocol,

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' =>
                [
                    'view' => function ($url, $model)
                    {
                        if (Otchett::$name == 'otchet63') {
                            return '';
                        }

                        $customurl = Yii::$app->getUrlManager()->createUrl(['otchett/view', 'id' => $model['id'], 'table' => Otchett::$name]);

                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customurl);
                    },
                    'update' => function ($url, $model)
                    {
                        if (Otchett::$name == 'otchet63') {
                            return '';
                        }

                        $customurl = Yii::$app->getUrlManager()->createUrl(['otchett/update', 'id' => $model['id'], 'table' => Otchett::$name]);

                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl);
                    }
                ],
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
    <?= Html::endForm();?> 

</div>
