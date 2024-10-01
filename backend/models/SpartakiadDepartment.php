<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spartakiad_department".
 *
 * @property int $id
 * @property string $name
 *
 * @property SpartakiadRating[] $spartakiadRatings
 */
class SpartakiadDepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spartakiad_department';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db10');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Управление',
        ];
    }

    /**
     * Gets query for [[SpartakiadRatings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpartakiadRatings()
    {
        return $this->hasMany(SpartakiadRating::class, ['department_id' => 'id']);
    }
}
