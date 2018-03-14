<?php

namespace backend\models;

use Yii;
use backend\models\Plannotes;

/**
 * This is the model class for table "planview".
 *
 * @property int $id
 * @property resource $name
 * @property resource $type
 *
 * @property Plantask[] $plantasks
 */
class Planview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planview';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'type'], 'string'],
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
            'type' => 'Вид',
        ];
    }

    public function getStatusCount($id)
    {
        $result = '';
        $status = Plannotes::find()
            ->select('status, COUNT(*) AS ct')
            ->innerJoinWith('pstages', 'planstages.id = plannotes.pstages_id')
            ->innerJoinWith('pstages.ptask', 'plantask.id = planstages.ptask_id')
            ->where(['and', ['plantask.pview_id' => $id], ['IS NOT', 'plannotes.status', null]])
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

    public function getTaskCount($pviewId)
    {
        $taskCount = Plantask::find()
            ->select('COUNT(*) AS ct')
            ->where(['pview_id' => $pviewId])
            ->groupBy('pview_id')
            ->createCommand()
            ->queryAll();

        foreach ($taskCount as $taskCountItem) {
            return $taskCountItem['ct'];
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlantasks()
    {
        return $this->hasMany(Plantask::className(), ['pview_id' => 'id']);
    }
}
