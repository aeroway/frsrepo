<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inventory_repair".
 *
 * @property int $id
 * @property string $area
 * @property string $name
 * @property string $invnum
 * @property string $inventory_moo
 * @property string $inventory_status
 * @property string $note
 * @property string $date_edit
 */
class InventoryRepair extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory_repair';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db4');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['area', 'name', 'inventory_moo', 'inventory_status', 'username'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 100],
            [['invnum'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 2048],
            [['date_edit'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Отдел',
            'name' => 'Название',
            'invnum' => 'Инв. номер',
            'inventory_moo' => 'МО',
            'inventory_status' => 'Статус',
            'note' => 'Комментарий',
            'email' => 'E-mail',
            'date_edit' => 'Редакт.',
        ];
    }

    public function sendEmailMo()
    {
        $send = Yii::$app->mailer->compose()
        ->setTo($this->email)
        ->setSubject('Техника на ремонт сотруднику ' . $this->inventory_moo)
        ->setHtmlBody(
            'Статус техники "' . $this->name . '"<br><br>' .
            'Инв. номер: ' . $this->invnum . '<br>' .
            'Статус: ' . $this->inventory_status . '<br>' .
            'Комментарии: ' . $this->note . '<br>' .
            'Накладная: http://10.23.112.112/docs/obrazec_nakladnoi_vnut_perem.xls'
        )
        ->send();
    }
}