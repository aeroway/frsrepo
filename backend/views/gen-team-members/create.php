<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GenTeamMembers $model */

$this->title = 'Добавить участника';
$this->params['breadcrumbs'][] = ['label' => 'Участники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gen-team-members-create">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
