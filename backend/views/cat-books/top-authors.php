<?php

use yii\helpers\Html;

$this->title = 'ТОП 10 авторов за года';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cat-books-top-authors">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Автор</th>
                <th>Год</th>
                <th>Количество книг</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topAuthors as $author): ?>
                <tr>
                    <td><?= Html::encode($author['author_name']) ?></td>
                    <td><?= Html::encode($author['year']) ?></td>
                    <td><?= Html::encode($author['books_published']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
