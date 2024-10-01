<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property string $name
 * @property int $subdivision_id
 *
 * @property Subdivision $subdivision
 * @property User[] $users
 * @property Ved[] $veds
 */
class VedjustAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db11');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'subdivision_id'], 'required'],
            [['subdivision_id'], 'default', 'value' => null],
            [['subdivision_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['subdivision_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subdivision::class, 'targetAttribute' => ['subdivision_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'subdivision_id' => 'Subdivision ID',
        ];
    }

    /**
     * Gets query for [[Subdivision]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubdivision()
    {
        return $this->hasOne(Subdivision::class, ['id' => 'subdivision_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['address_id' => 'id']);
    }

    /**
     * Gets query for [[Veds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVeds()
    {
        return $this->hasMany(Ved::class, ['address_id' => 'id']);
    }

    public function addressIdName()
    {
        return $this::find()
            ->joinWith('subdivision s')
            ->where(['s.agency_id' => 1])
            ->orderBy(['name' => SORT_ASC])
            ->all();
    }
}
