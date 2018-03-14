<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Plantask */

$this->params['breadcrumbs'][] = ['label' => 'Вид обращения', 'url' => ['planview/index']];
$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Задания', 'url' => ['index', 'id' => !empty($_GET['sid']) ? $_GET['sid'] : '',]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plantask-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
