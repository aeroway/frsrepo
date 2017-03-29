<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Lbo */

$this->params['breadcrumbs'][] = ['label' => 'Расход', 'url' => ['spending/index']];
$this->title = 'Создать ЛБО';
$this->params['breadcrumbs'][] = ['label' => 'ЛБО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lbo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
