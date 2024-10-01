<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\Otchetlist;
use backend\models\Stat21;
use backend\models\Otchett;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Отчёты';
//$this->params['breadcrumbs'][] = $this->title;
$otchett = new Otchett();
?>
<div class="otchetlist-index">


<?php
$subStrReplTblname = substr_replace($tblname, '', 0, 6);
$statTblname = (strlen($tblname) > 6) ? 'stat_' . $subStrReplTblname : 'stat';

$tblst = new Otchetlist();
$tblview = array($tblname => $statTblname);

$rows = (new \yii\db\Query())
    ->select('*')
    ->from($tblview[$tblname])
    ->orderBy(['vse' => SORT_DESC])
    ->all();

    $localVarOut = '<h1>' . $otchett->otchetList($tblname) . '</h1>';
    $localVarOut .= '<table cellpadding="7" border="2">';
    /*if ($tblname == 'otchet39') {
        $localVarOut .= '<head><tr><td>п/п</td><td><b>Отдел</b></td><td><b>Всего</b></td><td><b>Исправлено</b></td><td><b>В работе</b></td><td><b>Невозможно исправить</b></td><td><b>Не назначено</b></td><td><b>Повторные</b></td><td><b>Назначено</b></td><td><b>Не исправлено</b></td><td><b>%</b></td></tr></head>';
    } else*/if($tblname == 'otchet41' || $tblname == 'otchet42' || $tblname == 'otchet44' || $tblname == 'otchet47') {
        $localVarOut .= '<head><tr><td>п/п</td><td><b>Пользователь</b></td><td><b>Всего</b></td><td><b>Возврат по причине приостановки</b></td><td><b>Возврат по причине приостановки (повторно)</b></td><td><b>Забрали обратно</b></td><td><b>Зарегистрировано</b></td><td><b>Ненадлежащее рег. действие</b></td><td><b>Ошибка миграции</b></td><td><b>Отказать в выполнении УРД</b></td><td><b>В работе</b></td></tr></head>';
    } elseif($tblname == 'otchet63') {
        $localVarOut .= '<head><tr><td>п/п</td><td><b>Пользователь</b></td><td><b>Всего</b></tr></head>';
    } elseif($tblname == 'otchet67') {
        $localVarOut .= '<head><tr><td>п/п</td><td><b>Отдел</b></td><td><b>Всего</b></tr></head>';
    } else {
        $localVarOut .= '<head><tr><td>п/п</td><td><b>Отдел</b></td><td><b>Всего</b></td><td><b>Исправлено</b></td><td><b>В работе</b></td><td><b>Невозможно исправить</b></td><td><b>Не назначено</b></td><td><b>Повторные</b></td><td><b>Назначено</b></td></tr></head>';
    }

    $localVarOut .= '<body>';

$i = 1;

foreach($rows as $val)
{
    $localVarOut .= '<tr>';
    $localVarOut .= '<td>' . $i++ . '</td>';

    foreach($val as $val2)
    {
        $localVarOut .= '<td>' . $val2 . '</td>';
    }

    $localVarOut .= '</tr>';
}

if($tblname == 'otchet21' or $tblname == 'otchet27' or $tblname == 'otchet28')
    $localVarOut .= 
        '<tr>
            <td> </td>
            <td> </td>
            <td>' . (new \yii\db\Query())->from($tblname)->where("date_load >= '2017-11-01'")->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', "status = 'Исправлен'", "date_load >= '2017-11-01 00:00:00.000'"])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', "status = 'В работе'", "date_load >= '2017-11-01 00:00:00.000'"])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', "status = 'Невозможно исправить'", "date_load >= '2017-11-01 00:00:00.000'"])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', "status = 'Не назначено'", "date_load >= '2017-11-01 00:00:00.000'"])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', "flag = 1", "date_load >= '2017-11-01 00:00:00.000'"])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', "status = 'назначено'", "date_load >= '2017-11-01 00:00:00.000'"])->count() . '</td>
        </tr>';
elseif($tblname == 'otchet41' || $tblname == 'otchet42' || $tblname == 'otchet44' || $tblname == 'otchet47')
    $localVarOut .= 
        '<tr>
            <td> </td>
            <td> </td>
            <td>' . (new \yii\db\Query())->from($tblname)->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['protocol' => 'Возврат по причине приостановки'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['protocol' => 'Возврат по причине приостановки (повторно)'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['protocol' => 'Забрали обратно'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['protocol' => 'Зарегистрировано'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['protocol' => 'Ненадлежащее рег. действие'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['protocol' => 'Ошибка миграции'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['protocol' => 'Отказать в выполнении УРД'])->count() . '</td>
            <td>' . ((new \yii\db\Query())->from($tblname)->where(['IS', 'protocol', NULL])->count()) . '</td>
        </tr>';
elseif($tblname == 'otchet63')
    $localVarOut .= 
    '<tr>
        <td> </td>
        <td> </td>
        <td>' . (new \yii\db\Query())->from($tblname)->count() . '</td>
    </tr>';
elseif($tblname == 'otchet67')
    $localVarOut .= 
    '<tr>
        <td> </td>
        <td> </td>
        <td>' . (new \yii\db\Query())->from($tblname)->count() . '</td>
    </tr>';
else
    $localVarOut .= 
        '<tr>
            <td> </td>
            <td> </td>
            <td>' . (new \yii\db\Query())->from($tblname)->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', ['status' => 'Исправлен'], ['<>', 'flag', 1]])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['status' => 'В работе'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['status' => 'Невозможно исправить'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['status' => 'Не назначено'])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['flag' => 1])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['status' => 'назначено'])->count() . '</td>';

/*if ($tblname == 'otchet39') {
    $localVarOut .= '<td> </td><td> </td>';
}*/

$localVarOut .= '</tr>';
$localVarOut .= '</body>';
$localVarOut .= '</table>';



// exit(1);

// $arr_tab = array('otchet3', 'otchet41', 'otchet47', 'otchet42', 'otchet44', 'otchet9', 'otchet7', 'otchet14', 'otchet17', 'otchet19', 'otchet20', 'otchet39', 'otchet46', 'otchet50', 'otchet51', 'otchet52', 'otchet53', 'otchet54');

// if (in_array($tblname, $arr_tab)) {
//     if($tblname == 'otchet9') {
//         echo $tblst->getAltAreaa($tblname, 'kn');
//     } else {
//         echo $tblst->getAltAreaa($tblname, 'area');
//     }
// } else {
    echo $localVarOut;
// }
// else {
//     echo $tblst->getAreaa($tblname);
// }
?>

</div>

<?php die; ?>
