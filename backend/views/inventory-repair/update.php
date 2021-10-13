<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryRepair */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Техника на ремонт', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<?php if (in_array("ИТО", Yii::$app->user->identity->groups)): ?>
    <?php echo Html::a('Отправить письмо', ['send-email-mo', 'id' => $model->id], ['class' => 'btn btn-info']); ?>
<?php endif; ?>
<div class="inventory-repair-update">

    <h1><?php // echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
