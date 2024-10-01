<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subdivision".
 *
 * @property int $id
 * @property string $name
 * @property int|null $agency_id
 * @property int|null $subject_id
 *
 * @property Address[] $addresses
 * @property Agency $agency
 * @property Archive[] $archives
 * @property Subject $subject
 * @property User[] $users
 * @property Ved[] $veds
 */
class VedjustSubdivision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subdivision';
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
            [['name'], 'required'],
            [['agency_id', 'subject_id'], 'default', 'value' => null],
            [['agency_id', 'subject_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['agency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agency::class, 'targetAttribute' => ['agency_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subject_id' => 'id']],
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
            'agency_id' => 'Agency ID',
            'subject_id' => 'Subject ID',
        ];
    }

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::class, ['subdivision_id' => 'id']);
    }

    /**
     * Gets query for [[Agency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgency()
    {
        return $this->hasOne(Agency::class, ['id' => 'agency_id']);
    }

    /**
     * Gets query for [[Archives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchives()
    {
        return $this->hasMany(Archive::class, ['subdivision_id' => 'id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::class, ['id' => 'subject_id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['subdivision_id' => 'id']);
    }

    /**
     * Gets query for [[Veds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVeds()
    {
        return $this->hasMany(Ved::class, ['subdivision_id' => 'id']);
    }
}