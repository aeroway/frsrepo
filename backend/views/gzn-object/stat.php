<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\GznObject;
use backend\models\GznAdmPunishment;

$this->params['breadcrumbs'][] = ['label' => 'Объект проверок', 'url' => ['gzn-object/index']];
$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="gznobject-stat-view">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
		echo '<div class="form-group field-gznobject-stat-punishment">';
		echo '<label class="control-label">Сумма взысканного штрафа по статье КоАП РФ</label>';
		echo '<select class="form-control" id="selectPunishment">';
		echo '<option value="">Выберите Статью</option>';
		foreach(ArrayHelper::map(GznAdmPunishment::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name') as $key => $value)
		{
			echo '<option value="'.$key.'">'.$value.'</option>';
		}
		echo '</select>';
		echo '<div class="help-block"></div>';
		echo '</div>';
?>

    <div id="gznobject-punishment"></div>
    <?php //echo GznObject::getGznViolationsCount() ?>

</div>
