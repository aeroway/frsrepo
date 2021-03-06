<?php
/* @areaquery $this yii\web\View */

$this->title = 'Отчёты';

function altarea ($table, $area)
{
    $rowsaltarea = (new \yii\db\Query())
        ->select(["$area"])
        ->from("$table")
        ->distinct()
        ->orderBy(["$area" => SORT_ASC])
        ->all();

    for($i=0; $i < count($rowsaltarea);$i++)
    {
        $rowsaltareares = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->where(['or', ['and', 'status=null', ["$area" => $rowsaltarea[$i]["$area"]]], ['and', 'status=\'не назначено\'', ["$area" => $rowsaltarea[$i]["$area"]]]])
            ->all();
        if($rowsaltareares[0][''] > 0)
        {
            echo '<pre>';
            echo $rowsaltareares[0][''] . ' - ' . $rowsaltarea[$i]["$area"];
            echo '</pre>';            
        }
    }


}

function area($table)
{
    $area["23:01"] = "Абинск";
    $area["23:02"] = "Апшеронск";
    $area["23:03"] = "Белая глина";
    $area["23:04"] = "Брюховецкая";
    $area["23:05"] = "Выселки";
    $area["23:06"] = "Гулькевичи";
    $area["23:07"] = "Динская";
    $area["23:08"] = "Ейск";
    $area["23:09"] = "Кавказская";
    $area["23:10"] = "Калининская";
    $area["23:11"] = "Каневская";
    $area["23:12"] = "Кореновск";
    $area["23:13"] = "Красноармейская";
    $area["23:14"] = "Крыловская";
    $area["23:15"] = "Крымск";
    $area["23:16"] = "Курганинск";
    $area["23:17"] = "Кущевская";
    $area["23:18"] = "Лабинск";
    $area["23:19"] = "Ленинградская";
    $area["23:20"] = "Мостовская";
    $area["23:21"] = "Новокубанск";
    $area["23:22"] = "Новопокровская";
    $area["23:23"] = "Отрадная";
    $area["23:24"] = "Павловская";
    $area["23:25"] = "Приморско-Ахтарск";
    $area["23:26"] = "Северская";
    $area["23:27"] = "Славянск-на-Кубани";
    $area["23:28"] = "Староминская";
    $area["23:29"] = "Тбилисская";
    $area["23:30"] = "Темрюк";
    $area["23:31"] = "Тимашевск";
    $area["23:32"] = "Тихорецк - район";
    $area["23:33"] = "Туапсе";
    $area["23:34"] = "Успенская";
    $area["23:35"] = "Усть-Лабинск";
    $area["23:36"] = "Щербиновская";
    $area["23:37"] = "Анапа";
    $area["23:38"] = "Армавир";
    $area["23:39"] = "Белореченск";
    $area["23:40"] = "Геленджик";
    $area["23:41"] = "Горячий ключ";
    $area["23:42"] = "Ейск";
    $area["23:43"] = "Краснодар";
    $area["23:44"] = "Кропоткин";
    $area["23:45"] = "Крымск";
    $area["23:46"] = "Лабинск";
    $area["23:47"] = "Новороссийск";
    $area["23:48"] = "Славянск-на-Кубани";
    $area["23:49"] = "Сочи";
    $area["23:50"] = "Тихорецк - город";
    $area["23:51"] = "Туапсе";

    for($i=1; $i <= count($area); $i++)
    {
        if($i < 10)    {
            $areaquery = '23:0' . "$i" . ':%';
            $areanum = '23:0' . "$i";
        } else {
            $areaquery = '23:' . "$i" . ':%';
            $areanum = '23:' . "$i";
        }

        $rowsarea = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            //->where(['and', 'status=null', ['like', 'kn', "$areaquery", false]])
            ->where(['or', ['and', 'status=null', ['like', 'kn', "$areaquery", false]], ['and', 'status=\'не назначено\'', ['like', 'kn', "$areaquery", false]]])
            ->all();

        if($rowsarea[0][''] != '0')
        {
            echo '<pre>';
            echo $rowsarea[0][''] . ' - ' . $area["$areanum"] . '<br>';
            echo '</pre>';        
        }
    }
}

function status($table)
{
    $rows = (new \yii\db\Query())
        ->select('COUNT(*)')
        ->from("$table")
        ->where(['status' => 'Исправлен'])
        ->all();

    foreach($rows[0] as $otchetStatus0) {}

    $rows = (new \yii\db\Query())
        ->select('COUNT(*)')
        ->from("$table")
        ->where(['status' => 'Невозможно исправить'])
        ->all();

    foreach($rows[0] as $otchetStatus1) {}

    $rows = (new \yii\db\Query())
        ->select('COUNT(*)')
        ->from("$table")
        ->where(['or', 'status=null', 'status=\'не назначено\''])
        ->all();

    foreach($rows[0] as $otchetNull) {}

    $rows = (new \yii\db\Query())
        ->select('COUNT(*)')
        ->from("$table")
        ->all();

    foreach($rows[0] as $otchetSum) {}
    
    echo "<b>Исправлен:</b> $otchetStatus0<br>";
    echo "<b>Невозможно исправить:</b> $otchetStatus1<br>";
    echo "<b>Статус не назначен:</b> $otchetNull<br>";
    echo "<b>Всего:</b> $otchetSum";
}

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Отчёты</h1>

        <p class="lead">Выберите необходимый отчёт по ссылке ниже.</p>
        <!--
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        -->
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h2>Некорректные виды ОНИ-1</h2>

                <p>Различные типы ОНИ в ЕГРП и ГКН. Необходимо внести изменения в части вида ОНИ и привести к сведениям как в ГКН, 
                поскольку эта категория объектов была поставлена на учет органами БТИ до регистрации права.</p>
                <p><?php area('otchet'); ?></p>
                <p><?php status('otchet')?></p>

                <p><a class="btn btn-default" href="?r=otchet/index">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Дубли КН</h2>
                <p>Дубли кадастровых номеров.</p>
                <p><i>Срок исполнения до 01.02.2016</i></p>
                <p><?php area('otchet2'); ?></p>
                <p><?php status('otchet2')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet2">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Разделы ЕГРП</h2>
                <p>Разделы ЕГРП ликвидированы, права активны.</p>
                <p><i>Срок исполнения до 01.02.2016</i></p>
                <p style="color: red" </p>
                <p style="color: red">
                </p>
                <p><?php area('otchet3'); ?></p>
                <p><?php status('otchet3')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet3">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                
                <h2>ПИК</h2>
                <p></p>
                <p><?php area('otchet4'); ?></p>
                <p><?php status('otchet4')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet4">Перейти &raquo;</a></p>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <h2>Ошибочно сопоставленные</h2>
                <p>Отсутствуют в ГКН.</p>
                <p><i>Срок исполнения до 08.02.2016</i></p>
                <p><?php area('otchet5'); ?></p>
                <p><?php status('otchet5')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet5">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Земли лесного фонда</h2>
                <p></p>
                <p><?php area('otchet6'); ?></p>
                <p><?php status('otchet6')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet6">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Дубли ГКН</h2>
                <p>Дублирующиеся объекты недвижимости в ГКН,<br>в отношении которых в ЕГРП содержатся записи о государственной регистрации прав.</p>
                <p><i>Срок исполнения до 11.03.2016</i></p>
                <p><?php area('otchet8'); ?></p>
                <p><?php status('otchet8')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet8">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>ОНИ без КН</h2>
                <p>Во исполнение пункта 2.6 протокола селекторного совещания от 11.02.2016 №ЕГЮ-0043-СЗ необходимо представить в информацию о количестве и причинах отсутствия в ЕГРП сведений о КН объектов недвижимости</p>
                <p><i>Срок исполнения до 04.03.2016</i></p>
                <p><?php altarea('otchetn','area')?></p>
                <p><?php status('otchetn')?></p>

                <p><p><a class="btn btn-default" href="?r=otchetn/index">Перейти &raquo;</a></p></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <h2>Дубли субъектов</h2>
                <p>Двойники физических лиц.</p>
                <p><a href="/advanced/docs/dubli-fiz-lic.doc">Инструкция</a></p>
                <p><i>Срок исполнения с 14.03.2016 по 27.05.2016</i></p>
                <p><?php altarea('otchet9','kn')?></p>
                <p><?php status('otchet9')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet9">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Некорректные виды ОНИ-2</h2>
                <p><a href="/advanced/docs/sz-oni-2.docx">Служебная записка</a></p>
                <p><a target="_blank" href="/advanced/docs/09-isx-13873-re-15_02.10.2015_12.47.52.pdf">Письмо Росреестра</a></p>
                <p><i>Срок исполнения до 25.03.2016</i></p>
                <p><?php area('otchet10'); ?></p>
                <p><?php status('otchet10')?></p>

                <p><a class="btn btn-default" href="?r=otchett/index&table=otchet10">Перейти &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2> </h2>
                <p> </p>
                <p><i> </i></p>

                <p></p>

                <p></p>
            </div>
            <div class="col-lg-3">
                <h2> </h2>
                <p> </p>
                <p><i> </i></p>

                <p> </p>

                <p> </p>
            </div>
        </div>
    </div>
</div>
