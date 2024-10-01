<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Otcheterlmfc $model */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Ошибки МФЦ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otcheterlmfc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
