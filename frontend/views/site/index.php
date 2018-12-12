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
        <h1>Сервисы</h1>
        <p class="lead"><?= !Yii::$app->user->isGuest ?  'Вы вошли как: ' . Yii::$app->user->identity->fio : 'Выберите доступный сервис из списка ниже после авторизации.'; ?></p>
        <a type="button" class="btn btn-success" href="/backend/index.php?r=otchett/index&table=otchet41">Экстер ФГИС ЕГРН</a>
    </div>
    <div class="body-content">
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
