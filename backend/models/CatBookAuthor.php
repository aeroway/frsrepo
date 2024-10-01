<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cat_book_author".
 *
 * @property int $id
 * @property int $book_id
 * @property int $author_id
 *
 * @property CatAuthors $author
 * @property CatBooks $book
 */
class CatBookAuthor extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_book_author';
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
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'default', 'value' => null],
            [['book_id', 'author_id'], 'integer'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatAuthors::class, 'targetAttribute' => ['author_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatBooks::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(CatAuthors::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(CatBooks::class, ['id' => 'book_id']);
    }
}
