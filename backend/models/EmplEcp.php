<?php

namespace backend\models;

use backend\models\Employee;

use backend\models\Otdel;

use Yii;

/**
 * This is the model class for table "empl_ecp".
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
 * @property string $comment_ecp
 * @property string $ecpmodify_date
 * @property string $email
 * @property string $send
 */
class EmplEcp extends \yii\db\ActiveRecord
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
        return 'empl_ecp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['status', 'ecp_org_id', 'idm_empl', 'ecp_stop', 'email'], 'required'],
            [['idm_empl', 'ecp_org_id', 'status', 'nositel_type', 'send'], 'integer'],
            [['ecp_start', 'ecp_stop', 'date_in', 'req_date', 'ecpmodify_date', 'invent_num'], 'safe'],
            [['nositel_num', 'user_in', 'comment_ecp'], 'string'],
            [['email'], 'email'],
			[['ecp_start'], 'default', 'value' => null],
            [['ecp_stop', 'email', 'send'], 'default', 'value' => 0],
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
			->select(['employee.id', 'employee.fam', 'employee.name', 'employee.otch'])
			->where(['status' => 1, 'idm_otdel' => $id])
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

    public function sendEmail()
    {
        $modelEmplEcp = EmplEcp::find()
            ->innerJoinWith(['employeesEmployee'], true)
            ->where(['and', 
            [ '>=', 'ecp_stop', date('Y-m-d', strtotime("now"))],
            [ '<=', 'ecp_stop', date('Y-m-d', strtotime("+60 days"))],
            ['<>', 'ecp_stop', NULL],
            ['<>', 'email', NULL],
            ['=', 'send', 0]
        ])
        ->all();

        foreach ($modelEmplEcp as $value) {
            $send = Yii::$app->mailer->compose()
                ->setTo($value->email)
                ->setCc('s.zakharov@frskuban.ru')
                ->setSubject('ЭЦП сотруднику ' . $value->employeesEmployee->fam . '_' . $value->employeesEmployee->name . '_' . $value->employeesEmployee->otch)
                ->setHtmlBody('Заканчивается срок ЭЦП у специалиста '
                     . $value->employeesEmployee->fam . ' '
                     . $value->employeesEmployee->name . ' '
                     . $value->employeesEmployee->otch . ' '
                     . date('d.m.Y', strtotime($value->ecp_stop)) . '. '
                     . Yii::$app->params['ecpSend']
                 )
                ->send();

            if ($send) {
                $post = EmplEcp::findOne($value->id);
                $post->send = 1;
                $post->save();
            }
        }

        return 1;
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
            'ecpmodify_date' => 'Модификация',
            'user_in' => 'User In',
            'comment_ecp' => 'Комментарий',
			'invent_num' => 'Инвент. номер',
        ];
    }

    public function getEcpStopCount()
    {
        $localVarOut = '';

        $rows = EmplEcp::find()
            ->select('text, COUNT(*) AS ct')
            ->innerJoinWith('otdelsOtdel', 'otdel.id = empl_ecp.idm_otdel')
            ->where(['and', ['<=', 'empl_ecp.ecp_stop', date('Y-m-d', strtotime("+60 days"))], ['IS NOT', 'empl_ecp.ecp_stop', null]])
            ->groupBy('otdel.text')
            ->orderBy('otdel.text ASC')
            ->createCommand()->queryAll();

        $localVarOut .= '<table class="table table-bordered table-striped" style="width: 70%">';
        $localVarOut .= '<thead><tr><td>п/п</td><td><b>Отдел</b></td><td><b>Всего</b></td></tr></thead>';

        $localVarOut .= '<tbody>';

        $i = 1;

        foreach($rows as $key => $val)
        {
            $localVarOut .= '<tr>';
            $localVarOut .= '<td>' . $i++ . '</td>';
            $localVarOut .= '<td>' . $val["text"] . '</td>';
            $localVarOut .= '<td>' . $val["ct"] . '</td>';
            $localVarOut .= '</tr>';
        }

        $localVarOut .= '</tbody>';
        $localVarOut .= '</table>';

        return $localVarOut;
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
