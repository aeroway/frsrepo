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

$tblst = new Otchetlist();
$tblview = array(
    'otchet' => 'stat',
    'otchet2' => 'stat_2',
    'otchet3' => 'stat_3',
    'otchet7' => 'stat_7',
    'otchet9' => 'stat_9',
    'otchet10' => 'stat_10',
    'otchet11' => 'stat_11',
    'otchet12' => 'stat_12',
    'otchet13' => 'stat_13',
    'otchet14' => 'stat_14',
    'otchet15' => 'stat_15',
    'otchet16' => 'stat_16',
    'otchet17' => 'stat_17',
    'otchet18' => 'stat_18',
    'otchet19' => 'stat_19',
    'otchet20' => 'stat_20',
    'otchet21' => 'stat_21',
    'otchet22' => 'stat_22',
    'otchet23' => 'stat_23',
    'otchet24' => 'stat_24',
    'otchet25' => 'stat_25',
    'otchet26' => 'stat_26',
    'otchet27' => 'stat_27',
    'otchet28' => 'stat_28',
    'otchet29' => 'stat_29',
    'otchet31' => 'stat_31',
    'otchet32' => 'stat_32',
    'otchet33' => 'stat_33',
    'otchet34' => 'stat_34',
    'otchet35' => 'stat_35',
    'otchet36' => 'stat_36',
    'otchet37' => 'stat_37',
    'otchetn' => 'stat_n',
    'otchet41' => 'stat_41',
    'otchet42' => 'stat_42',
    'otchet44' => 'stat_44',
    'otchetur' => 'stat_ur',
    'otchetfiz' => 'stat_fiz',
    'otchet39' => 'stat_39',
);

if(
    $tblname == 'otchet'
    or $tblname == 'otchet2'
    or $tblname == 'otchet3'
    or $tblname == 'otchet7'
    or $tblname == 'otchet9'
    or $tblname == 'otchet10'
    or $tblname == 'otchet11'
    or $tblname == 'otchet12'
    or $tblname == 'otchet13'
    or $tblname == 'otchet14'
    or $tblname == 'otchet15'
    or $tblname == 'otchet16'
    or $tblname == 'otchet17'
    or $tblname == 'otchet18'
    or $tblname == 'otchet19'
    or $tblname == 'otchet20'
    or $tblname == 'otchet21'
    or $tblname == 'otchet22'
    or $tblname == 'otchet23'
    or $tblname == 'otchet24'
    or $tblname == 'otchet25'
    or $tblname == 'otchet26'
    or $tblname == 'otchet27'
    or $tblname == 'otchet28'
    or $tblname == 'otchet29'
    or $tblname == 'otchet31'
    or $tblname == 'otchet32'
    or $tblname == 'otchet33'
    or $tblname == 'otchet34'
    or $tblname == 'otchet35'
    or $tblname == 'otchet36'
    or $tblname == 'otchet37'
    or $tblname == 'otchetn'
    or $tblname == 'otchet41'
    or $tblname == 'otchet42'
    or $tblname == 'otchet44'
    or $tblname == 'otchetur'
    or $tblname == 'otchetfiz'
    or $tblname == 'otchet39'
) {
    $rows = (new \yii\db\Query())
        ->select('*')
        ->from($tblview[$tblname])
        ->orderBy(['vse' => SORT_DESC])
        ->all();

        $localVarOut = '<h1>' . $otchett->otchetList($tblname) . '</h1>';
        $localVarOut .= '<table cellpadding="7" border="2">';
        /*if ($tblname == 'otchet39') {
            $localVarOut .= '<head><tr><td>п/п</td><td><b>Отдел</b></td><td><b>Всего</b></td><td><b>Исправлено</b></td><td><b>В работе</b></td><td><b>Невозможно исправить</b></td><td><b>Не назначено</b></td><td><b>Повторные</b></td><td><b>Назначено</b></td><td><b>Не исправлено</b></td><td><b>%</b></td></tr></head>';
        } else*/if($tblname == 'otchet41' || $tblname == 'otchet42' || $tblname == 'otchet44') {
            $localVarOut .= '<head><tr><td>п/п</td><td><b>Пользователь</b></td><td><b>Всего</b></td><td><b>Возврат по причине приостановки</b></td><td><b>Возврат по причине приостановки (повторно)</b></td><td><b>Забрали обратно</b></td><td><b>Зарегистрировано</b></td><td><b>Ненадлежащее рег. действие</b></td><td><b>Ошибка миграции</b></td><td><b>Отказать в выполнении УРД</b></td><td><b>В работе</b></td></tr></head>';
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
    elseif($tblname == 'otchet41' || $tblname == 'otchet42' || $tblname == 'otchet44')
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
    else
        $localVarOut .= 
            '<tr>
                <td> </td>
                <td> </td>
                <td>' . (new \yii\db\Query())->from($tblname)->count() . '</td>
                <td>' . (new \yii\db\Query())->from($tblname)->where(['status' => 'Исправлен'])->count() . '</td>
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

    echo $localVarOut;

    exit(1);
}

$arr_tab = array('otchet3', 'otchetn', 'otchet41', 'otchet42', 'otchet44', 'otchet9', 'otchet7', 'otchet14', 'otchet17', 'otchet19', 'otchet20', 'otchet39');

if(in_array($tblname, $arr_tab))
{
    if($tblname == 'otchet9')
    {
        echo $tblst->getAltAreaa($tblname, 'kn');
    }
    else
    {
        echo $tblst->getAltAreaa($tblname, 'area');
    }
}
else
{
    echo $tblst->getAreaa($tblname);
}

?>

</div>

<?php die; ?>
