<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
/* @areaquery $this yii\web\View */

$this->title = 'Прием ведомостей';
?>
    <div class="jumbotron">
        <h1>Проверка ведомостей</h1>

        <p class="lead">Отсканируйте штрихкод с ведомости <br />и нажмите на кнопку Проверить.</p>
        <!--
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        -->
    </div>
    



<?php Pjax::begin(); ?>
<div class="text-center">
<?= Html::beginForm(['site2/checkm'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
    <?= Html::input('text', 'num', Yii::$app->request->post('num'), ['class' => 'form-control']) ?>
    <?= Html::submitButton('Проверить', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']) ?>
<?= Html::endForm() ?>
<h3><?= $result ?></h3>

<?php
if (isset($otvet)){
    if ($otvet->DT_ACTL!=NULL){
        ?>
        <?= Html::img('@web/images/good.png', ['alt' => 'Ведомость сформирована']) ?>
        <?php
      //  echo ':)';    
    } else {
    //    echo ':(';
        ?>
        <?= Html::img('@web/images/bad.png', ['alt' => 'Ведомость не сформирована']) ?>
        <?php
    }
    
    
} 
?>
</div>
<?php Pjax::end(); ?>