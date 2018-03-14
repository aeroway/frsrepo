<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plantask".
 *
 * @property int $id
 * @property resource $name
 * @property resource $username
 * @property string $date_task
 * @property int $pview_id
 *
 * @property Plannotes[] $plannotes
 * @property Planstages[] $planstages
 * @property Planview $pview
 */
class Plantask extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plantask';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'username'], 'string'],
            [['date_task'], 'safe'],
            [['pview_id'], 'integer'],
            [['pview_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planview::className(), 'targetAttribute' => ['pview_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'username' => 'Кто создал',
            'date_task' => 'Дата',
            'pview_id' => 'Вид обр.',
        ];
    }

    public function getStatusCount($id)
    {
        $result = '';
        $status = Plannotes::find()
            ->select('status, COUNT(*) AS ct')
            ->innerJoinWith('pstages', 'planstages.id = plannotes.pstages_id')
            ->where(['and', ['planstages.ptask_id' => $id], ['IS NOT', 'plannotes.status', null]])
            ->groupBy('plannotes.status')
            ->createCommand()->queryAll();

        foreach ($status as $statusItem) {
            if ($statusItem['status'] == 0)
                $result .= '<p title="Некритичные" class="bg-warning" style="padding: 10px; text-align: center; float: left;">' . '' . $statusItem['ct'] . '</p>';
            if ($statusItem['status'] == 1)
                $result .= '<p title="Критичные" class="bg-danger" style="padding: 10px; text-align: center; float: left;">' . '' . $statusItem['ct'] . '</p>';
            if ($statusItem['status'] == 2)
                $result .= '<p title="Нет замечаний" class="bg-success" style="padding: 10px; text-align: center; float: left;">' . '' . $statusItem['ct'] . '</p>';
        }

        return $result;
    }

    public function getEmployeeDepartment($username)
    {
        $usernameClear = substr_replace($username, '', 0, 6);
        $usernameInfo = Yii::$app->Ldap->user()->info($usernameClear);

        $fio = explode(' ', $usernameInfo[0]['displayname'][0]);

        if(!empty($fio[2])) {

            $departmentNum = Employee::find()
                ->select('idm_otdel')
                ->where(['and',
                    ['fam' => $fio[0]],
                    ['name' => $fio[1]],
                    ['otch' => $fio[2]]])
                ->one();

            if($departmentNum) {
                $departmentName = Otdel::find()
                    ->select('text')
                    ->where(['id' => $departmentNum["idm_otdel"]])
                    ->createCommand()->queryAll();

                return $departmentName[0]["text"];

            } else {
                return 'Отдел неопределён для: ' . $fio[0] . ' ' . $fio[1] . ' ' . $fio[2];
            }

        } else {
            return 'Неопределён';
        }
    }

    public function getEmployeeDepartmentCount()
    {
        $arrCount = array();
        $localVarOut = '';

        $nameUsers = Plantask::find()
                    ->select('username')
                    ->createCommand()->queryAll();

        foreach($nameUsers as $username) {
            $arrCount[] = self::getEmployeeDepartment($username["username"]);
        }

        $rows = array_count_values($arrCount);
        ksort($rows);

        $localVarOut .= '<table class="table table-bordered table-striped">';
        $localVarOut .= '<thead><tr><td>п/п</td><td><b>Отдел</b></td><td><b>Всего</b></td></tr></thead>';

        $localVarOut .= '<tbody>';

        $i = 1;

        foreach($rows as $key => $val)
        {
            $localVarOut .= '<tr>';
            $localVarOut .= '<td>' . $i++ . '</td>';
            $localVarOut .= '<td>' . $key . '</td>';
            $localVarOut .= '<td>' . $val . '</td>';
            $localVarOut .= '</tr>';
        }

        $localVarOut .= '</tbody>';
        $localVarOut .= '</table>';

        return $localVarOut;
    }

    public function getPlanviewName()
    {
        return $this->pview->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlannotes()
    {
        return $this->hasMany(Plannotes::className(), ['pstages_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanstages()
    {
        return $this->hasMany(Planstages::className(), ['ptask_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPview()
    {
        return $this->hasOne(Planview::className(), ['id' => 'pview_id']);
    }
}
