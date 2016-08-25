<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ab_employee".
 *
 * @property integer $id
 * @property integer $id_employee
 * @property integer $act
 * @property string $dt1
 * @property string $dt2
 *
 * @property AbEmplSys[] $abEmplSys
 */
class AbEmployee extends \yii\db\ActiveRecord
{
	public $systemslist, $id_status;

    public static function getDb()
    {
        return \Yii::$app->db3;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ab_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_employee', 'act', 'dt1', 'dt2'], 'required'],
            [['id_employee', 'act'], 'integer'],
            [['dt1', 'dt2', 'systemslist', 'id_status'], 'safe']
        ];
    }

	public function getFullName()
	{
		if(!empty($this->idEmployee->fam) and !empty($this->idEmployee->name) and !empty($this->idEmployee->otch)) {
			return $this->idEmployee->fam . ' ' . $this->idEmployee->name . ' ' . $this->idEmployee->otch;
		} else{
			return 'Неполные данные по ФИО';
		}
	}

	public function getFullSystems($id)
	{
		$res = AbEmplSys::find()->where(['id_empl'=>$id])->all();

		for($i = 0; count($res)-1 >= $i; $i++)
		{
			$res2 = AbSystems::find()->where(['id'=>$res[$i]["id_systems"]])->all();

			foreach($res2 as $res2value)
				$res3[] = $res2value["name"];
		}

		return implode(', ', $res3);
	}

	public function getStatus($id)
	{
		$res = AbEmplSys::find()->where(['id_empl'=>$id])->all();

		for($i = 0; count($res)-1 >= $i; $i++)
		{
			$res2 = AbStatus::find()->where(['id'=>$res[$i]["id_status"]])->all();

			foreach($res2 as $res2value)
				$res3 = $res2value["name"];
		}

		return $res3;
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_employee' => 'Сотрудник',
            'act' => 'Активность',
            'dt1' => 'Начало',
            'dt2' => 'Завершение',
			'systemslist' => 'Системы',
			'id_status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbEmplSys()
    {
        return $this->hasMany(AbEmplSys::className(), ['id_empl' => 'id']);
    }

    public function getIdEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'id_employee']);
    }
	
	public function getAllEmployee($id)
	{
		$newEmployeeArray = '';
		$result = '';

		$employee = Employee::find()
			->select(['employee.id', 'employee.fam','employee.name','employee.otch'])
			->where(['status'=>1,'idm_otdel'=>$id])
			->orderBy(['fam' => SORT_ASC])
			->all();

		for($i = 0; $i <= count($employee)-1; $i++)
		{
			$tmpid = $employee[$i]['id'];
			$tmpname = $employee[$i]['fam'] . ' ' . $employee[$i]['name'] . ' ' . $employee[$i]['otch'];

			$result .= '<option value="'.$tmpid.'">'.$tmpname.'</option>';
		}

		return $result;
	}
}
