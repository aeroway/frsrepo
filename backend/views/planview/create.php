<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Planview */

$this->title = 'Создать обращение';
$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
