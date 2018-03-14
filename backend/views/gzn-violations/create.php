<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GznViolations */

$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['gzn-object/index']];
$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Нарушения', 'url' => ['index', 'id' => !empty($_GET['sid']) ? $_GET['sid'] : '',]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-violations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
