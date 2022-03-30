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
    'otchet47' => 'stat_47',
    'otchetur' => 'stat_ur',
    'otchetfiz' => 'stat_fiz',
    'otchet39' => 'stat_39',
    'otchet46' => 'stat_46',
    'otchet45' => 'stat_45',
    'otchet48' => 'stat_48',
    'otchet49' => 'stat_49',
    'otchet50' => 'stat_50',
    'otchet51' => 'stat_51',
    'otchet52' => 'stat_52',
    'otchet53' => 'stat_53',
    'otchet54' => 'stat_54',
    'otchet55' => 'stat_55',
    'otchet56' => 'stat_56',
    'otchet57' => 'stat_57',
    'otchet58' => 'stat_58',
    'otchet59' => 'stat_59',
    'otchet60' => 'stat_60',
    'otchet62' => 'stat_62',
    'otchet63' => 'stat_63',
    'otchet64' => 'stat_64',
    'otchet65' => 'stat_65',
    'otchet66' => 'stat_66',
    'otchet67' => 'stat_67',
    'otchet68' => 'stat_68',
    'otchet69' => 'stat_69',
    'otchet70' => 'stat_70',
    'otchet71' => 'stat_71',
    'otchet72' => 'stat_72',
    'otchet73' => 'stat_73',
    'otchet74' => 'stat_74',
    'otchet75' => 'stat_75',
    'otchet76' => 'stat_76',
    'otchet77' => 'stat_77',
    'otchet78' => 'stat_78',
    'otchet79' => 'stat_79',
    'otchet80' => 'stat_80',
    'otchet81' => 'stat_81',
    'otchet82' => 'stat_82',
    'otchet83' => 'stat_83',
    'otchet84' => 'stat_84',
    'otchet85' => 'stat_85',
    'otchet86' => 'stat_86',
    'otchet87' => 'stat_87',
    'otchet88' => 'stat_88',
    'otchet89' => 'stat_89',
    'otchet92' => 'stat_92',
    'otchet93' => 'stat_93',
    'otchet94' => 'stat_94',
    'otchet95' => 'stat_95',
    'otchet96' => 'stat_96',
    'otchet97' => 'stat_97',
    'otchet98' => 'stat_98',
    'otchet99' => 'stat_99',
    'otchet100' => 'stat_100',
    'otchet101' => 'stat_101',
    'otchet102' => 'stat_102',
    'otchet103' => 'stat_103',
    'otchet104' => 'stat_104',
    'otchet105' => 'stat_105',
    'otchet106' => 'stat_106',
    'otchet107' => 'stat_107',
    'otchet108' => 'stat_108',
    'otchet109' => 'stat_109',
    'otchet113' => 'stat_113',
    'otchet114' => 'stat_114',
    'otchet115' => 'stat_115',
    'otchet116' => 'stat_116',
    'otchet117' => 'stat_117',
    'otchet118' => 'stat_118',
    'otchet119' => 'stat_119',
    'otchet120' => 'stat_120',
    'otchet121' => 'stat_121',
    'otchet122' => 'stat_122',
    'otchet123' => 'stat_123',
    'otchet124' => 'stat_124',
    'otchet125' => 'stat_125',
    'otchet126' => 'stat_126',
    'otchet127' => 'stat_127',
    'otchet128' => 'stat_128',
    'otchet129' => 'stat_129',
    'otchet130' => 'stat_130',
    'otchet131' => 'stat_131',
    'otchet132' => 'stat_132',
    'otchet133' => 'stat_133',
    'otchet134' => 'stat_134',
    'otchet135' => 'stat_135',
    'otchet136' => 'stat_136',
    'otchet137' => 'stat_137',
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
    or $tblname == 'otchet47'
    or $tblname == 'otchetur'
    or $tblname == 'otchetfiz'
    or $tblname == 'otchet39'
    or $tblname == 'otchet46'
    or $tblname == 'otchet45'
    or $tblname == 'otchet48'
    or $tblname == 'otchet49'
    or $tblname == 'otchet50'
    or $tblname == 'otchet51'
    or $tblname == 'otchet52'
    or $tblname == 'otchet53'
    or $tblname == 'otchet54'
    or $tblname == 'otchet55'
    or $tblname == 'otchet56'
    or $tblname == 'otchet57'
    or $tblname == 'otchet58'
    or $tblname == 'otchet59'
    or $tblname == 'otchet60'
    or $tblname == 'otchet62'
    or $tblname == 'otchet63'
    or $tblname == 'otchet64'
    or $tblname == 'otchet65'
    or $tblname == 'otchet66'
    or $tblname == 'otchet67'
    or $tblname == 'otchet68'
    or $tblname == 'otchet69'
    or $tblname == 'otchet70'
    or $tblname == 'otchet71'
    or $tblname == 'otchet72'
    or $tblname == 'otchet73'
    or $tblname == 'otchet74'
    or $tblname == 'otchet75'
    or $tblname == 'otchet76'
    or $tblname == 'otchet77'
    or $tblname == 'otchet78'
    or $tblname == 'otchet79'
    or $tblname == 'otchet80'
    or $tblname == 'otchet81'
    or $tblname == 'otchet82'
    or $tblname == 'otchet83'
    or $tblname == 'otchet84'
    or $tblname == 'otchet85'
    or $tblname == 'otchet86'
    or $tblname == 'otchet87'
    or $tblname == 'otchet88'
    or $tblname == 'otchet89'
    or $tblname == 'otchet92'
    or $tblname == 'otchet93'
    or $tblname == 'otchet94'
    or $tblname == 'otchet95'
    or $tblname == 'otchet96'
    or $tblname == 'otchet97'
    or $tblname == 'otchet98'
    or $tblname == 'otchet99'
    or $tblname == 'otchet100'
    or $tblname == 'otchet101'
    or $tblname == 'otchet102'
    or $tblname == 'otchet103'
    or $tblname == 'otchet104'
    or $tblname == 'otchet105'
    or $tblname == 'otchet106'
    or $tblname == 'otchet107'
    or $tblname == 'otchet108'
    or $tblname == 'otchet109'
    or $tblname == 'otchet113'
    or $tblname == 'otchet114'
    or $tblname == 'otchet115'
    or $tblname == 'otchet116'
    or $tblname == 'otchet117'
    or $tblname == 'otchet118'
    or $tblname == 'otchet119'
    or $tblname == 'otchet120'
    or $tblname == 'otchet121'
    or $tblname == 'otchet122'
    or $tblname == 'otchet123'
    or $tblname == 'otchet124'
    or $tblname == 'otchet125'
    or $tblname == 'otchet126'
    or $tblname == 'otchet127'
    or $tblname == 'otchet128'
    or $tblname == 'otchet129'
    or $tblname == 'otchet130'
    or $tblname == 'otchet131'
    or $tblname == 'otchet132'
    or $tblname == 'otchet133'
    or $tblname == 'otchet134'
    or $tblname == 'otchet135'
    or $tblname == 'otchet136'
    or $tblname == 'otchet137'
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

    echo $localVarOut;

    exit(1);
}

$arr_tab = array('otchet3', 'otchetn', 'otchet41', 'otchet47', 'otchet42', 'otchet44', 'otchet9', 'otchet7', 'otchet14', 'otchet17', 'otchet19', 'otchet20', 'otchet39', 'otchet46', 'otchet50', 'otchet51', 'otchet52', 'otchet53', 'otchet54');

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
