<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GznViolations */

$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['gzn-object/index']];
$this->title = 'Редактировать: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Нарушения', 'url' => ['index', 'id' => $model->gzn_obj_id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="gzn-violations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
