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
$localVarOut = '<h1>' . $otchett->otchetList($tblname) . '</h1>';
$localVarOut .= '<table cellpadding="7" border="2">';
$localVarOut .= '<head><tr><td>п/п</td><td><b>ФИО</b></td><td><b>Всего</b></td></tr></head>';
$localVarOut .= '<body>';

$i = 1;

foreach($employee as $empl)
{
    $localVarOut .= '<tr>';
    $localVarOut .= '<td>' . $i++ . '</td>';

    foreach($empl as $empl2)
    {
        $localVarOut .= '<td>' . $empl2 . '</td>';
    }

    $localVarOut .= '</tr>';
}


$localVarOut .= '</tr>';
$localVarOut .= '</body>';
$localVarOut .= '</table>';

echo $localVarOut;

exit(1);

?>

</div>

<?php die; ?>
