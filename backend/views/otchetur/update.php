<?php

use yii\helpers\Html;
use backend\models\Otchetur;

/* @var $this yii\web\View */
/* @var $model backend\models\Otchetur */

$this->title = 'Редактировать: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование доходов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';

$otchetur = new Otchetur();
Yii::$app->session->setFlash('table', Otchetur::$name);
?>
<div class="otchetur-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
