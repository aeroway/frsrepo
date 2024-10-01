<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\CatAuthors;

/** @var yii\web\View $this */
/** @var backend\models\CatBooks $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cat-books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!-- Поле для отображения текущего изображения -->
    <?php if ($model->image): ?>
        <div class="form-group">
            <?= Html::img(Yii::getAlias('@web/uploads/cat-books/') . $model->image, ['class' => 'img-thumbnail', 'style' => 'max-width: 200px;']) ?>
        </div>
    <?php endif; ?>

    <!-- Поле для загрузки нового изображения -->
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->textarea(['rows' => '6']) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authors')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(CatAuthors::find()->all(), 'id', 'name'),
        'options' => [
            'multiple' => true,
            'value' => empty($selectedAuthors) ? '' : $selectedAuthors,
            'placeholder' => 'Выберите авторов ...'
        ],
    ])->label('Авторы') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
