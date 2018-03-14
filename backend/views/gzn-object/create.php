<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GznObject */

$this->title = 'Создать объект проверок';
$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gzn-object-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsGznViolations' => $modelsGznViolations,
    ]) ?>

</div>
