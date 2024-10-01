<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cat_authors".
 *
 * @property int $id
 * @property string $name
 *
 * @property CatBookAuthor[] $catBookAuthors
 */
class CatAuthors extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_authors';
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
            [['name'], 'string', 'max' => 128],
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
        ];
    }

    /**
     * Gets query for [[CatBookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatBookAuthors()
    {
        return $this->hasMany(CatBookAuthor::className(), ['author_id' => 'id']);
    }

    public function getCatBooks()
    {
        return $this->hasMany(CatBooks::className(), ['id' => 'book_id'])
            ->viaTable('cat_book_author', ['author_id' => 'id']);
    }
}
