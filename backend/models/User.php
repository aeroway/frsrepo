<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $subdivision_id
 *
 * @property Subdivision $subdivision
 * @property Ved[] $veds
 * @property Ved[] $veds0
 */
class User extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db7;  
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'string'],
            [['status', 'created_at', 'updated_at', 'subdivision_id'], 'integer'],
            [['subdivision_id'], 'exist', 'skipOnError' => true, 'targetClass' => VedjustSubdivision::className(), 'targetAttribute' => ['subdivision_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'subdivision_id' => 'Subdivision ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubdivision()
    {
        return $this->hasOne(VedjustSubdivision::className(), ['id' => 'subdivision_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeds()
    {
        return $this->hasMany(VedjustVed::className(), ['user_accepted_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeds0()
    {
        return $this->hasMany(VedjustVed::className(), ['user_created_id' => 'id']);
    }
}
