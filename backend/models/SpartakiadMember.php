<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spartakiad_member".
 *
 * @property int $id
 * @property string $name
 * @property int $department_id
 * @property string $guidBarcode
 * @property int $flag
 * @property int $sport_type
 *
 * @property SpartakiadDepartment $department
 */
class SpartakiadMember extends \yii\db\ActiveRecord
{
    public $guidBarcode;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spartakiad_member';
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
            [['name', 'department_id', 'flag', 'sport_type'], 'required'],
            [['department_id', 'flag'], 'default', 'value' => 0],
            [['department_id', 'flag'], 'integer'],
            [['name', 'sport_type'], 'string', 'max' => 255],
            [['guidBarcode'], 'string'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpartakiadDepartment::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'department_id' => 'Управление',
            'guidBarcode' => 'Barcode',
            'flag' => 'Метка',
            'sport_type' => 'Вид спорта',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(SpartakiadDepartment::class, ['id' => 'department_id']);
    }

    public function activation($id) {
        return $this::updateAll(['flag' => 1], ['=', 'department_id', $id]);
    }

    public function deactivation($id) {
        return $this::updateAll(['flag' => 0], ['=', 'department_id', $id]);
    }

    public function getStatusBarcode() {
        return Yii::$app->session->getFlash('successCheckSpartakiadMemberStatusBarcode');
    }

    public function statusSpartakiadMemberBarcode()
    {
        if (empty($this->guidBarcode)) {
            return false;
        }

        $statusBarcode = $this::updateAll(
            ['flag' => 1,],
            ['=', 'department_id', $this->guidBarcode],
        );

        if ($statusBarcode >= 0) {
            \Yii::$app->session->setFlash('successCheckSpartakiadMemberBarcode', 'block');
            \Yii::$app->session->setFlash('successCheckSpartakiadMemberStatusBarcode', $statusBarcode);
        }

        return $statusBarcode;
    }
}
