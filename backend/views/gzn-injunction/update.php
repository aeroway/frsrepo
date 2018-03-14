<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GznInjunction */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['gzn-object/index']];
$this->params['breadcrumbs'][] = ['label' => 'Нарушения', 'url' => ['gzn-violations/index', 'id' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->title = 'Редактировать предписание';
$this->params['breadcrumbs'][] = ['label' => 'Предписания', 'url' => ['index', 'id' => $model->gzn_violations_id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="gzn-injunction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
