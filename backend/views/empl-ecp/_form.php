<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\EmplEcpStatus;
use backend\models\EmplEcpOrg;
use backend\models\Employee;
use yii\jui\DatePicker;
use backend\models\Otdel;

/* @var $this yii\web\View */
/* @var $model backend\models\EmplEcp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empl-ecp-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php

	if(strpos(Yii::$app->request->get("r"),'create'))
	{
		echo '<div class="form-group field-emplecp-status required">';
		echo '<label class="control-label">Отдел</label>';
		echo '<select class="form-control" id="yourSelect">';
		echo '<option value="">Выберите Отдел</option>';
		foreach (
            ArrayHelper::map(Otdel::find()
                ->innerJoin('employee', 'otdel.id = employee.idm_otdel')
                ->where(['employee.status' => 1])
                ->orderBy(['text' => SORT_ASC])
                ->all(), 'id', 'text') as $key => $value
        ) {
			echo '<option value="'.$key.'">'.$value.'</option>';
		}
		echo '</select>';
		echo '<div class="help-block"></div>';
		echo '</div>';

		echo $form->field($model, 'idm_empl')->dropDownList([''=>'Для начала выберите Отдел']);

		/* Это если понадобится сформировать полный список с юзерами. Можно сгруппированный по отделам, но будет дольше загружаться.
		$employee = Employee::find()
			->select(['employee.id', 'employee.fam','employee.name','employee.otch'])
			//->joinWith('otdelText')
			->where(['status'=>1])
			->orderBy(['fam' => SORT_ASC])
			->all();
			
		for($i = 0; $i <= count($employee)-1; $i++)
		{
			$newEmployeeArray[$i]['id'] = $employee[$i]['id'];
			$newEmployeeArray[$i]['name'] = $employee[$i]['fam'] . ' ' . $employee[$i]['name'] . ' ' . $employee[$i]['otch'];
			//$newEmployeeArray[$i]['text'] = $employee[$i]['otdelText']['text'];
		}

		echo $form->field($model, 'idm_empl')->dropDownList(
				ArrayHelper::map($newEmployeeArray,'id','name'),
				['prompt'=>'Выберите сотрудника']
			);
		*/
	};

	if(in_array("EcpAdmin", Yii::$app->user->identity->groups))
	{
		echo $form->field($model, 'ecp_org_id')->dropDownList(
				ArrayHelper::map(EmplEcpOrg::find()->all(),'id','text'),
				['prompt'=>'Выберите УЦ']
		);

		echo $form->field($model, 'ecp_start')->widget(DatePicker::classname(), [
			'language' => 'ru',
			'dateFormat' => 'yyyy-MM-dd',
			'options' => [
				'class' => 'form-control',
			],
            'clientOptions' => [
                'dateFormat' => 'dd-mm-yyyy',
                'showAnim' => 'fold',
                'changeMonth' => true,
                'changeYear' => true,
                'autoSize' => true,
                //'showOn' => "button",
                //'buttonImage' => "images/calendar.gif",
                'htmlOptions' => [
                    'style' => 'width: 80px;',
                    'font-weight' => 'x-small',
                ]
            ],
		]);

		echo $form->field($model, 'ecp_stop')->widget(DatePicker::classname(), [
			'language' => 'ru',
			'dateFormat' => 'yyyy-MM-dd',
			'options' => [
				'class' => 'form-control'
			],
			'clientOptions' => [
                'dateFormat' => 'dd-mm-yyyy',
                'showAnim' => 'fold',
                'changeMonth' => true,
                'changeYear' => true,
                'autoSize' => true,
	            //'showOn' => "button",
			    //'buttonImage' => "images/calendar.gif",
                'htmlOptions' => [
                	'style' => 'width: 80px;',
	            	'font-weight' => 'x-small',
	        	]
        	],
		]);

		echo $form->field($model, 'invent_num')->textInput();
	}

	echo $form->field($model, 'nositel_num')->textInput();
	echo $form->field($model, 'status')->dropDownList(
			ArrayHelper::map(EmplEcpStatus::find()->all(),'id','text'),
			['prompt'=>'Выберите статус']
	);

	?>

    <?= $form->field($model, 'comment_ecp')->textInput() ?>

    <?= $form->field($model, 'ecpmodify_date')->textInput(['readonly' => true, 'value' => date("Y-m-d H:i:s") ]) ?>

    <?php /*= $form->field($model, 'nositel_type')->textInput() */?>

    <?php /*= $form->field($model, 'date_in')->textInput() */?>

    <?php /*= $form->field($model, 'req_date')->textInput() */?>

    <?php /*= $form->field($model, 'user_in')->textInput() */?>

    <?= $form->field($model, 'email')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
