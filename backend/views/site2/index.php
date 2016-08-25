<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
echo  'Вы вошли как: '.Yii::$app->user->identity->fio.'<br />';


?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Прием дел в архив!</h1>

        <p class="lead"></p>

        
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Реестр проверенных ведомостей</h2>

                <p>Здесь находятся все ведомости, которые были проверены с положительным или отрицательным результатами.</p>

                <p><a class="btn btn-success" href="index.php?r=site2/indexved">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Прием ведомостей по штрихкоду</h2>

                <p>Здесь происходит проверка и прием ведомостей с помощью сканера штрих-кода.</p>

                <p><a class="btn btn-success" href="index.php?r=site2/check">Перейти&raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Прием ведомостей по номеру</h2>

                <p>Здесь происходит проверка и прием ведомостей без сканера штрих-кода.</p>

                <p><a class="btn btn-success" href="index.php?r=site2/checkm">Перейти &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
