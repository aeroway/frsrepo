<?php

namespace backend\models;

use backend\models\Employee;

use backend\models\Otdel;

use Yii;

/**
 * This is the model class for table "empl_ecp_log".
 *
 * @property integer $id
 * @property integer $idm_empl
 * @property string $ecp_start
 * @property string $ecp_stop
 * @property integer $ecp_org_id
 * @property integer $status
 * @property string $nositel_num
 * @property integer $nositel_type
 * @property string $date_in
 * @property string $req_date
 * @property string $user_in
 * @property string $invent_num
 * @property string $comment_ecp
 * @property string $ecpmodify_date
 * @property integer $empl_ecp_id
 *
 * @property EmplEcp $emplEcp
 */
class EmplEcpLog extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db5;  
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empl_ecp_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idm_empl', 'ecp_org_id', 'status', 'nositel_type', 'empl_ecp_id'], 'integer'],
            [['ecp_start', 'ecp_stop', 'date_in', 'req_date', 'ecpmodify_date'], 'safe'],
            [['nositel_num', 'user_in', 'invent_num', 'comment_ecp', 'username'], 'string']
        ];
    }

	public function getFullName()
	{
		if(!empty($this->idm_empl))
		{
			return $this->employeesEmployee->fam . ' ' . $this->employeesEmployee->name . ' ' . $this->employeesEmployee->otch;
		}
		else
		{
			return false;
		}
	}

	public function getEcpOrgName()
	{
		return $this->ecporgsEcporg->text;
	}

	public function getStatustxt()
	{
		return $this->statusStatus->text;
	}

	public function getDoljnost()
	{
		return $this->employeesEmployee->doljnostName;
	}

	public function getOtdels()
	{
		return $this->employeesEmployee->otdelsName;
	}

	public function getAllEmployee($id)
	{
		$newEmployeeArray = '';
		$result = '';

		$employee = Employee::find()
			->select(['employee.id', 'employee.fam','employee.name','employee.otch'])
			->where(['idm_otdel'=>$id])
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idm_empl' => 'ФИО',
			'fullName' => Yii::t('app', 'Full Name'),
            'ecp_start' => 'Дата выдачи',
            'ecp_stop' => 'Дата окончания',
            'ecp_org_id' => 'УЦ',
            'status' => 'Статус',
            'nositel_num' => 'Номер носителя',
            'nositel_type' => 'Тип носителя',
            'date_in' => 'Date In',
            'req_date' => 'Req Date',
            'user_in' => 'User In',
			'invent_num' => 'Инвент. номер',
            'comment_ecp' => 'Комментарий',
            'ecpmodify_date' => 'Модификация',
            'empl_ecp_id' => 'Empl Ecp ID',
            'username' => 'Редактировал',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmplEcp()
    {
        return $this->hasOne(EmplEcp::className(), ['id' => 'empl_ecp_id']);
    }

    public function getEmployeesEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'idm_empl']);
    }

    public function getEcporgsEcporg()
    {
        return $this->hasOne(EmplEcpOrg::className(), ['id' => 'ecp_org_id']);
    }

    public function getStatusStatus()
    {
        return $this->hasOne(EmplEcpStatus::className(), ['id' => 'status']);
    }

	public function getOtdelsOtdel() 
	{
        return $this->hasMany(Otdel::className(), ['id' => 'idm_otdel'])
			->viaTable(Employee::tableName(), ['id' => 'idm_empl']);
	}
}
