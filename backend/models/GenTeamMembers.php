<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gen_team_members".
 *
 * @property int $id
 * @property string $full_name
 * @property string $position
 * @property int $agency_id
 * @property string $guidBarcode
 * @property int $statusBarcode
 * @property int $team
 */
class GenTeamMembers extends \yii\db\ActiveRecord
{
    public $guidBarcode;
    public $statusBarcode;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gen_team_members';
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
            [['full_name', 'position', 'agency_id'], 'required'],
            [['agency_id', 'statusBarcode'], 'default', 'value' => null],
            [['agency_id', 'statusBarcode', 'team'], 'integer'],
            [['full_name', 'position'], 'string', 'max' => 255],
            [['guidBarcode'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'ФИО',
            'position' => 'Категория',
            'agency_id' => 'Организация',
            'guid' => 'GUID',
            'AgencyName' => 'Организация',
            'guidBarcode' => 'Barcode',
            'team' => 'Команда',
        ];
    }

    public function getAgencyName()
    {
        switch ($this->agency_id) {
            case 1:
                return 'УРР';
                break;
            case 2:
                return 'ПКК';
                break;
            case 3:
                return 'РБ';
                break;
            default:
                return '';
        }
    }

    public function statusGenTeamBarcode()
    {
        if (empty($this->guidBarcode)) {
            return false;
        }

        $statusBarcode = $this::updateAll(
            ['flag' => 1,],
            ['=', 'guid', strtolower($this->guidBarcode)],
        );

        if ($statusBarcode >= 0) {
            \Yii::$app->session->setFlash('successCheckGenTeamBarcode', 'block');
            \Yii::$app->session->setFlash('successCheckGenTeamStatusBarcode', $statusBarcode);
        }

        return $statusBarcode;
    }

    public function unsetSession() {
        \Yii::$app->getSession()->setFlash('successCheckGenTeamBarcode', 'none');
        \Yii::$app->getSession()->setFlash('successCheckGenTeamStatusBarcode', '');
    }

    public function getStatusBarcode() {
        return Yii::$app->session->getFlash('successCheckGenTeamStatusBarcode');
    }

    public function selectAgencyTeamId($cnt, $agency) {
        $strId = array();
        $i = 1;

        $arrIds = $this::find()
            ->select(['id'])
            ->where(['and',
                ['IS', 'team', NULL],
                ['=', 'position', 'Участник'],
                ['=', 'agency_id', $agency],
                ['=', 'flag', 1]
            ])
            ->orderBy('random()')
            ->limit($cnt)
            ->all();

        $countElements = count($arrIds);

        foreach ($arrIds as $id) {
            if ($countElements == 0) {
                return 0;
            }

            if ($countElements >= $i) {
                $strId[] = $id->id;
            }

            $i++;
        }

        return $strId;
    }

    public function countTeam() {
        return $this::find()->where(['and', ['IS', 'team', NULL], ['=', 'position', 'Участник'], ['=', 'flag', 1]])->count();
    }

    public function resetTeam() {
        return $this::updateAll(['team' => NULL], ['=', 'position', 'Участник']);
    }

    public function createTeam() {
        $this->resetTeam();
        $i = 1;

        while ($this->countTeam() > 0) {
            $this::updateAll(['team' => $i], ['in', 'id', $this->selectAgencyTeamId(4, 1)]);
            $this::updateAll(['team' => $i], ['in', 'id', $this->selectAgencyTeamId(1, 2)]);
            $this::updateAll(['team' => $i], ['in', 'id', $this->selectAgencyTeamId(1, 3)]);

            $i++;
        }
    }

    public function activation($id) {
        return $this::updateAll(['flag' => 1], ['=', 'id', $id]);
    }

    public function deactivation($id) {
        return $this::updateAll(['flag' => 0], ['=', 'id', $id]);
    }
}