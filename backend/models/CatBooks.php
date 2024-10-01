<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\Html;

/**
 * This is the model class for table "cat_books".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property string|null $description
 * @property string $isbn
 * @property string|null $image
 *
 * @property CatBookAuthor[] $catBookAuthors
 */

class CatBooks extends ActiveRecord
{
    public $authors;
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_books';
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
            [['title', 'year', 'isbn'], 'required'],
            [['year'], 'default', 'value' => null],
            [['year'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1024],
            [['isbn'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg',
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
            'title' => 'Название',
            'year' => 'Год',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            // 'image' => 'Фото',
            'imageBook' => 'Превью',
            'imageFile' => 'Фото',
        ];
    }

    public function getImageBook() {
        return Html::img(Yii::getAlias('@web/uploads/cat-books/') . $this->image, ['class' => 'img-thumbnail', 'style' => 'max-width: 200px;']);
    }

    /**
     * Gets query for [[CatBookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatBookAuthors()
    {
        return $this->hasMany(CatBookAuthor::class, ['book_id' => 'id']);
    }

    public function getAuthors()
    {
        return $this->hasMany(CatAuthors::class, ['id' => 'author_id'])
            ->viaTable('cat_book_author', ['book_id' => 'id']);
    }
}
