<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Plannotes */

$this->title = 'Создать замечание';
$this->params['breadcrumbs'][] = ['label' => 'Замечания', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plannotes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formmodal', [
        'model' => $model,
    ]) ?>

</div>
