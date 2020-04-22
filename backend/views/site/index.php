<?php
/* @var $this yii\web\View */
$this->title = 'Сервисы';

// Проверка прав доступа
function statusList($label)
{
    if ( !(Yii::$app->user->identity) ) { return 'display:none'; }
    if ( $label == '' ) { return 'display:block;'; }
    if ( (!array_intersect ( $label, !empty(Yii::$app->user->identity->groups) ? Yii::$app->user->identity->groups : array('0' => '') )) ) { return 'display:none;'; }
}

// Генерация кнопок
function button($gitem)
{
    $query = new yii\db\Query;
    $query->select('url,group_name,title,description,icon,bg_color')
        ->from('account_system')
        ->where("group_item = $gitem");
    $command = $query->createCommand();
    $data = $command->queryAll();

    foreach($data as $value)
    {
        $bgcolor = $value["bg_color"];
        $url = $value["url"];
        $icon = $value["icon"];
        $title = $value["title"];
        $description = $value["description"];
        $groupName = $value["group_name"];

        if($groupName != '') $labels = explode(", ", $groupName);
            else $labels = '';

        echo "
                <div class=\"tile $bgcolor fg-white\" data-role=\"tile\" onClick=\"window.location.href='$url'\" style=\"" . statusList($labels) . "\">
                    <div class=\"tile-content slide-down-2\">
                        <div class=\"slide\">
                            <div class=\"tile-content iconic\">
                                <span class=\"icon $icon\"></span>
                                <span class=\"tile-label\">$title</span>
                            </div>
                        </div>
                        <div class=\"slide-over op-darkTeal text-small padding10\">
                        $description
                        </div>
                    </div>
                </div>
            ";
    }
}
?>

<div class="site-index">
    <div class="jumbotron">
        <p class="lead"><?= !Yii::$app->user->isGuest ?  'Вы вошли как: ' . Yii::$app->user->identity->fio : 'Выберите доступный сервис из списка ниже после авторизации.'; ?></p>
    </div>
    <div class="body-content">
        <div class="row">
            <!--<a target="_blank" href="/index.php?r=otchett/index&table=otchet42" style="margin: 5px;" class="btn btn-success btn-sm">Экстер ФГИС ЕГРН</a>-->
            <a target="_blank" href="/index.php?r=inventory-repair" style="margin: 5px;" class="btn btn-success">Ремонт принтеров</a>
            <a target="_blank" href="https://www.rosreestr.ru/site/" style="margin: 5px;" class="btn btn-default">Управление Росреестра [rosreestr]</a>
            <a target="_blank" href="http://www.frskuban.ru/" style="margin: 5px;" class="btn btn-default">Управление Росреестра [frskuban]</a>
            <a target="_blank" href="http://intranet.rosreestr.ru/" style="margin: 5px;" class="btn btn-default">Внутренний портал Росреестра [intranet]</a>
            <a target="_blank" href="http://bankrot.fedresurs.ru/" style="margin: 5px;" class="btn btn-default">Реестр банкротов</a>
            <a target="_blank" href="http://10.23.143.1/vvs.ru/" style="margin: 5px;" class="btn btn-default">Форум ФКП [vvs]</a>
            <a target="_blank" href="http://10.23.112.38/topos/Boxes.aspx" style="margin: 5px;" class="btn btn-default">Топография архива</a>
            <a target="_blank" href="http://10.23.113.44/cert_rayon/" style="margin: 5px;" class="btn btn-default">Экстерриториальная регистрация</a>
            <a target="_blank" href="http://10.23.113.44/sudotdel/" style="margin: 5px;" class="btn btn-default">Судебная практика</a>
            <a target="_blank" href="http://10.23.112.38/MWS" style="margin: 5px;" class="btn btn-default">Проверка арестов</a>
            <a target="_blank" href="http://10.23.113.55:9861/regist/default.aspx" style="margin: 5px;" class="btn btn-default">Портал отчётов [113.55]</a>
            <a target="_blank" href="http://10.128.21.4/app/" style="margin: 5px;" class="btn btn-default">Техпортал ЕСРОО</a>
            <!--<a target="_blank" href="http://10.23.112.4/index.php?option=com_oktest" style="margin: 5px;" class="btn btn-primary btn-sm">Классный чин</a>-->
            <?php
            if(in_array("ИТО", Yii::$app->user->identity->groups) && Yii::$app->user->identity->username != 'Осипов СЛ') {
                echo yii\helpers\Html::a('Отчёт по звонкам в ТП', ['otchetlist/stat-index-tp'], ['class' => 'btn btn-default']);
            }
            ?>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h2>Справочные сервисы</h2>
                <div class="tile-container">
                    <?php button(1); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <h2>Услуги Управления</h2>
                <div class="tile-container">
                    <?php button(2); ?>
                </div>
            </div>
            <div class="col-lg-4">
                <h2>Отдел Архива</h2>
                <div class="tile-container">
                    <?php button(3); ?>
                </div>
            </div>
        </div>
    </div>
</div>
