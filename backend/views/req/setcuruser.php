<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Req */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="req-setcuruser">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formsetcuruser', [
        'model' => $model,
    ]) ?>

</div>
