<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "VedomostCheckForm".
 *
 * @property integer $id
 * @property string $date_in
 * @property string $user_in
 * @property integer $vedomost_num
 * @property string $vedomost_date
 * @property integer $vedomost_res
 * @property integer $check_type
 * @property string $module
 */
class VedomostCheckForm extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db2;  
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'VedomostCheckForm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_in', 'vedomost_date'], 'safe'],
            [['user_in', 'module'], 'string'],
            [['vedomost_num', 'vedomost_res', 'check_type','sektors_ip'], 'integer']
        ];
    }
	public function getIconStatus()
	{
		switch ($this->vedomost_res) {
			case 1:
				return '<span class="glyphicon glyphicon-ok" title="Выполнена"> </span>';
				break;
			case 0:
				return '<span class="glyphicon glyphicon-remove" title="Отказ"> </span>';
				break;
			default:
				return $this->vedomost_res;
		}
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_in' => 'Входящие',
            'user_in' => 'Пользователь',
            'vedomost_num' => 'Номер ведомости',
            'vedomost_date' => 'Vedomost Date',
            'vedomost_res' => 'Результат',
            'check_type' => 'Check Type',
            'module' => 'Module',
			'sektors_ip' => 'Размещение',
        ];
    }
	
	public function getSektorsSektor()
	{
		return $this->hasOne(Sektors::className(), ['ip' => 'sektors_ip']);
	}
}
