<?php

//use yii\helpers\Html;
//use yii\grid\GridView;

use backend\models\Otchetlist;
//use backend\models\Stat21;
use backend\models\Otchett;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Отчёты';
//$this->params['breadcrumbs'][] = $this->title;
$otchett = new Otchett();
?>
<div class="otchetlist-stat-39-range">




<?php

$tblst = new Otchetlist();
$tblview = array(
    'otchet39' => 'stat39Range',
    'otchet41' => 'stat41Range',
);

if($tblname == 'otchet39') {
    $rows = Yii::$app->db->createCommand("SELECT * FROM $tblview[$tblname]('" . Yii::$app->request->post('fromDate') . "', '" . Yii::$app->request->post('tillDate') . "')")->queryAll();
/*
    (new \yii\db\Query())
        ->select('*')
        ->from($tblview[$tblname]('2018-08-27', '2018-08-31'))
        ->orderBy(['vse' => SORT_DESC])
        ->all();
*/
        $localVarOut = '<h1>' . $otchett->otchetList($tblname) . '</h1>';
        $localVarOut .= '<table cellpadding="7" border="2">';
        $localVarOut .= '<head><tr><td>п/п</td><td><b>Отдел</b></td><td><b>Всего</b></td><td><b>Исправлено</b></td><td><b>В работе</b></td><td><b>Невозможно исправить</b></td><td><b>Не назначено</b></td><td><b>Повторные</b></td><td><b>Назначено</b></td><!--<td><b>Не исправлено</b></td><td><b>%</b></td>--></tr></head>';

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

    $localVarOut .= 
        '<tr>
            <td> </td>
            <td> </td>
            <td>' . (new \yii\db\Query())->from($tblname)->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', ['status' => 'Исправлен'], ['>=', 'date', Yii::$app->request->post('fromDate')], ['<=', 'date', Yii::$app->request->post('tillDate')]])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', ['status' => 'В работе'], ['>=', 'date', Yii::$app->request->post('fromDate')], ['<=', 'date', Yii::$app->request->post('tillDate')]])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', ['status' => 'Невозможно исправить'], ['>=', 'date', Yii::$app->request->post('fromDate')], ['<=', 'date', Yii::$app->request->post('tillDate')]])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', ['status' => 'Не назначено'], ['>=', 'date', Yii::$app->request->post('fromDate')], ['<=', 'date', Yii::$app->request->post('tillDate')]])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', ['flag' => 1], ['>=', 'date', Yii::$app->request->post('fromDate')], ['<=', 'date', Yii::$app->request->post('tillDate')]])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)->where(['and', ['status' => 'назначено'], ['>=', 'date', Yii::$app->request->post('fromDate')], ['<=', 'date', Yii::$app->request->post('tillDate')]])->count() . '</td>
            <!--<td> </td>
            <td> </td>-->
        </tr>';
    $localVarOut .= '</body>';
    $localVarOut .= '</table>';

    echo $localVarOut;

    exit(1);
}

if($tblname == 'otchet41') {
    $rows = Yii::$app->db->createCommand("SELECT * FROM $tblview[$tblname]('" . Yii::$app->request->post('fromDate') . "', '" . Yii::$app->request->post('tillDate') . "', '" . Yii::$app->request->post('username') . "')")->queryAll();

    $localVarOut = '<h1>' . $otchett->otchetList($tblname) . '</h1>';
    $localVarOut .= '<table cellpadding="7" border="2">';
    $localVarOut .= '<head><tr><td>п/п</td><td><b>Пользователь</b></td><td><b>Всего</b></td><td><b>Возврат по причине приостановки</b></td><td><b>Зарегистрировано</b></td><td><b>Ненадлежащее рег. действие</b></td><td><b>Ошибка миграции</b></td></tr></head>';

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

    $localVarOut .= 
        '<tr>
            <td> </td>
            <td> </td>
            <td>' . (new \yii\db\Query())->from($tblname)
                ->where(['and', 
                    ['>=', 'date', Yii::$app->request->post('fromDate')], 
                    ['<=', 'date', Yii::$app->request->post('tillDate')], 
                    ['like', 'username', Yii::$app->request->post('username')]])
                ->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)
                ->where(['and', 
                    ['>=', 'date', Yii::$app->request->post('fromDate')], 
                    ['<=', 'date', Yii::$app->request->post('tillDate')], 
                    ['like', 'username', Yii::$app->request->post('username')],
                    ['protocol' => 'Возврат по причине приостановки']])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)
                ->where(['and', 
                    ['>=', 'date', Yii::$app->request->post('fromDate')], 
                    ['<=', 'date', Yii::$app->request->post('tillDate')], 
                    ['like', 'username', Yii::$app->request->post('username')],
                    ['protocol' => 'Зарегистрировано']])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)
                ->where(['and', 
                    ['>=', 'date', Yii::$app->request->post('fromDate')], 
                    ['<=', 'date', Yii::$app->request->post('tillDate')], 
                    ['like', 'username', Yii::$app->request->post('username')],
                    ['protocol' => 'Ненадлежащее рег. действие']])->count() . '</td>
            <td>' . (new \yii\db\Query())->from($tblname)
                ->where(['and', 
                    ['>=', 'date', Yii::$app->request->post('fromDate')], 
                    ['<=', 'date', Yii::$app->request->post('tillDate')], 
                    ['like', 'username', Yii::$app->request->post('username')],
                    ['protocol' => 'Ошибка миграции']])->count() . '</td>
        </tr>';

    $localVarOut .= '</tr>';
    $localVarOut .= '</body>';
    $localVarOut .= '</table>';

    echo $localVarOut;

    exit(1);
}

$arr_tab = array('otchet39');

if(in_array($tblname, $arr_tab))
{
    echo $tblst->getAltAreaa($tblname, 'area');
}
else
{
    echo $tblst->getAreaa($tblname);
}

?>

</div>

<?php die; ?>
