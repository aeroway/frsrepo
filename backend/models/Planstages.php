<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "planstages".
 *
 * @property int $id
 * @property string $name
 * @property string $executor
 * @property int $ptask_id
 *
 * @property Plannotes[] $plannotes
 * @property Plantask $ptask
 */
class Planstages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planstages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'executor'], 'string'],
            [['ptask_id'], 'integer'],
            [['ptask_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plantask::className(), 'targetAttribute' => ['ptask_id' => 'id']],
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
            'executor' => 'Исполнитель',
            'ptask_id' => 'Задание',
        ];
    }

    public function getTextNote()
    {
        $notesText = '';

        foreach ($this->plannotes as $notesItem) {
            if ($notesItem['status'] === 0)
                $notesText .=  '<p class="bg-warning" style="padding: 10px;">';
            elseif ($notesItem['status'] === 1)
                $notesText .=  '<p class="bg-danger" style="padding: 10px;">';
            elseif ($notesItem['status'] === 2)
                $notesText .=  '<p class="bg-success" style="padding: 10px;">';
            else
                $notesText .=  '<p>';

            $notesText .= $notesItem['text'];

            $notesText .= '</p>';
        }

        return $notesText;
    }

    public function getPlannotesAction()
    {
        $notesAction = '';

        foreach ($this->plannotes as $notesItem) {
            if ($notesItem['status'] === 0)
                $notesAction .=  '<p class="bg-warning" style="padding: 10px;">';
            elseif ($notesItem['status'] === 1)
                $notesAction .=  '<p class="bg-danger" style="padding: 10px;">';
            elseif ($notesItem['status'] === 2)
                $notesAction .=  '<p class="bg-success" style="padding: 10px;">';
            else
                $notesAction .=  '<p>';

            $notesAction .= $notesItem['action'] . '<br>';

            $notesAction .= '</p>';
        }

        return $notesAction;
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
    public function getPtask()
    {
        return $this->hasOne(Plantask::className(), ['id' => 'ptask_id']);
    }
}
