<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GznInjunction */

$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['gzn-object/index']];
$this->params['breadcrumbs'][] = ['label' => 'Нарушения', 'url' => ['gzn-violations/index', 'id' => !empty($_GET['pid']) ? $_GET['pid'] : '',]];
$this->title = 'Создать предписание';
$this->params['breadcrumbs'][] = ['label' => 'Предписания', 'url' => ['index', 'id' => !empty($_GET['sid']) ? $_GET['sid'] : '', 'pid' => !empty($_GET['pid']) ? $_GET['pid'] : '',]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-injunction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
