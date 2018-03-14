<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Planstages */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['plantask/index', 'id' => !empty($_GET['pid']) ? $_GET['pid'] : '',]];
$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Этапы', 'url' => ['index', 'id' => !empty($_GET['sid']) ? $_GET['sid'] : '', 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planstages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPlannotes' => $modelsPlannotes,
    ]) ?>

</div>
