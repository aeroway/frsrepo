<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\OtchetFns;
use backend\models\StatFns;
//use backend\models\Otchett;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetFnsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Отчёты';
//$this->params['breadcrumbs'][] = $this->title;
//$otchett = new Otchett();
?>
<div class="otchet-fns-index">

<?php
$localVarOut = '<h1>Перечни без правообладателя</h1>';
$localVarOut .= '<table cellpadding="7" border="2">';
$localVarOut .= '<head><tr>
    <td>п/п</td>
    <td><b>Отдел</b></td>
    <td><b>Всего</b></td>
    <td><b>Взят в работу (ОМС)</b></td>
    <td><b>Снят с учёта</b></td>
    <td><b>Выявлен правообладатель<br>(внесено в ЕГРН)</b></td>
    <td><b>Зарегистрировано<br>право</b></td>
    <td><b>Не подлежит<br>выявлению</b></td>
    <td><b>Не отработано</b></td></tr></head>';
$localVarOut .= '<body>';

$i = 1;

foreach($fns as $stat)
{
    $localVarOut .= '<tr>';
    $localVarOut .= '<td>' . $i++ . '</td>';

    foreach($stat as $stat2)
    {
        $localVarOut .= '<td>' . $stat2 . '</td>';
    }

    $localVarOut .= '</tr>';
}

$localVarOut .= '</tr>';

$localVarOut .= '<tr>
<td> </td>
<td> </td>
<td>' . (new \yii\db\Query())->from('otchetfns')->count() . '</td>
<td>' . (new \yii\db\Query())->from('otchetfns')->where(['and', ['status' => 'Взят в работу (ОМС)'], ['<>', 'flag', 1]])->count() . '</td>
<td>' . (new \yii\db\Query())->from('otchetfns')->where(['status' => 'Снят с учёта'])->count() . '</td>
<td>' . (new \yii\db\Query())->from('otchetfns')->where(['status' => 'Выявлен правообладатель (внесено в ЕГРН)'])->count() . '</td>
<td>' . (new \yii\db\Query())->from('otchetfns')->where(['status' => 'Зарегистрировано право'])->count() . '</td>
<td>' . (new \yii\db\Query())->from('otchetfns')->where(['status' => 'Не подлежит выявлению'])->count() . '</td>
<td>' . (new \yii\db\Query())->from('otchetfns')->where(['flag' => 2])->count() . '</td>';

$localVarOut .= '</tr>';


$localVarOut .= '</body>';
$localVarOut .= '</table>';

echo $localVarOut;

exit(1);

?>

</div>

<?php die; ?>
