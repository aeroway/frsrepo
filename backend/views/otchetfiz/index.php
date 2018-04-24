<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\Otchetfiz;
use yii\helpers\ArrayHelper;
use backend\models\Employee;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetfizSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$otchetfiz = new Otchetfiz();

$this->title = 'Администрирование доходов физ. лица';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetfiz-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php
    //echo $this->render('_search', ['model' => $searchModel]);
    Yii::$app->session->setFlash('table', 'Otchetfiz');
?>

    <p>
        <?php /* echo Html::a('Create Otchetfiz', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?=Html::beginForm(['otchetfiz/bulk'],'post');?>
    <?php
    if(in_array("OtchetManager", Yii::$app->user->identity->groups))
    {
        echo Html::dropDownList('action', '', ArrayHelper::map(Employee::find()
            ->where(['and', ['or', ['idm_otdel' => 139], ['idm_otdel' => 3], ['idm_otdel' => 170]], ['status' => 1]])
            ->orderBy(['fam' => SORT_ASC])
            ->all(),
        'fullName', 'fullName'),
        ['class' => 'form-control', 'style' => 'width: 90%; margin-bottom: 10px; margin-right: 10px; float: left']);

        echo Html::submitButton('Назначить', ['class' => 'btn btn-info', 'style' => 'margin-bottom: 10px;']);
    }
    ?>

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
            'kn',
            'number_book',
            'full_name',
            //'birth_date',
            'name',
            'adr_txt',
            //'name1',
            //'name2',
            //'name3',
            'fl',
            'status',
            //'comment',
            //'date',
            'username',
            //'flag',
            //'filename',
            //'date_update',
            //'date_load',
            'cost',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>
                [
                    'view'=>function ($url, $model) 
                    {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['otchetfiz/view', 'id'=>$model['id']]);

                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customurl);
                    },
                    'update'=>function ($url, $model) 
                    {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['otchetfiz/update', 'id'=>$model['id']]);

                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl);
                    }
                ],
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
    <?= Html::endForm();?> 

</div>
