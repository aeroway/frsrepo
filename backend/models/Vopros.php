<?php

namespace backend\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "vopros".
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $otdel_id
 * @property int|null $nv
 */
class Vopros extends \yii\db\ActiveRecord
{
    public $cnt;
    public $date_start;
    public $date_stop;
    public $username;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vopros';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'otdel_id'], 'required'],
            [['nv', 'cnt'], 'integer'],
            [['text'], 'string', 'max' => 2000],
            [['otdel_id', 'date_start', 'date_stop', 'username'], 'safe'],
            [['image'], 'file',
                'extensions' => 'jpg, png',
                'mimeTypes' => 'image/jpeg, image/png',
                'maxSize' => 512000,
                'tooBig' => 'Limit 500KB',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Вопрос',
            'otdel_id' => 'Отдел',
            'nv' => 'Nv',
            'cnt' => 'Кол-во',
            'date_start' => 'Начало',
            'date_stop' => 'Окончание',
            'username' => 'Пользователь',
            'image' => 'Изображение',
        ];
    }

    public function questionRes($id)
    {
        $questionId = Res::find()
            ->select('id_vopros')
            ->where(['and'
                , ['<=', 'date_in', date("Y-m-d 23:59:59.999")]
                , ['>=', 'date_in', date("Y-m-d 00:00:00.000")]
                , ['otdel_id' => $id]
                , ['fio' => empty(Yii::$app->user->identity->fio) ? Yii::$app->user->identity->username : Yii::$app->user->identity->fio]
            ]);

        return $this::find()
            ->select('vopros.id, vopros.text, vopros.otdel_id, vopros.image')
            ->innerJoin('otdel', 'vopros.otdel_id = otdel.id')
            ->where(['and'
                , ['vopros.otdel_id' => $id]
                , ['<=', 'otdel.date_start', date("Y-m-d H:i:s.000")]
                , ['>=', 'otdel.date_stop', date("Y-m-d H:i:s.000")]
                , ['NOT IN', 'vopros.id', $questionId]
            ])
            ->orderBy(new Expression('newid()'))
            ->limit(1)
            ->one();
    }

    public function answers($id)
    {
        return Otvet::find()
            ->select('id, text, pr')
            ->where(['=', 'vopros_id', $id])
            ->all();
    }

    public function getOtdel()
    {
        return $this->hasOne(Otdel::className(), ['id' => 'otdel_id']);
    }

    public function getOtvet()
    {
        return $this->hasOne(Otvet::className(), ['vopros_id' => 'id']);
    }

    public function getRes()
    {
        return $this->hasOne(Res::className(), ['id_vopros' => 'id']);
    }
}
