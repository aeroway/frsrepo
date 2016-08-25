<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "otchetn".
 *
 * @property integer $id
 * @property string $area
 * @property string $reason1
 * @property string $reason2
 * @property string $offer
 * @property string $comment
 * @property string $condnum
 * @property string $flag
 * @property string $id_dpt
 * @property string $filename
 * @property string $id_egrp
 * @property string $date_update
 * @property string $date_load
 */
class Otchetn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otchetn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area', 'status', 'reason1', 'reason2', 'offer', 'comment', 'condnum', 'flag', 'usernameon', 'filename'], 'string'],
			[['id_dpt', 'id_egrp'], 'integer'],
			[['dateon', 'date_update', 'date_load'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Район',
            'status' => 'Статус',
            'reason1' => 'Причина',
            'reason2' => 'Кол-во',
            'offer' => 'Предложения',
            'comment' => 'Примечание',
            'condnum' => 'УН',
			'flag' => 'Ошибка',
			'dateon' => 'Дата',
			'usernameon' => 'Пользователь',
			'flag' => 'Метка',
			'id_dpt' => 'id dpt',
			'filename' => 'Файл',
			'id_egrp' => 'id',
			'date_update' => 'Обновление',
			'date_load' => 'Загружено',
        ];
    }
    
    public function getAllErrors($idotdel){
        
        //$sql = "select count(id) count_ from otchetn
//                where status = 'Исправлен'
//                group by area";
//        
//        //area = (select name from area where id = ".$idotdel.") and 
//        $model = new Area;
//        $data = $model->query($sql);
//        
        return $idotdel;
        
        
    }
}
