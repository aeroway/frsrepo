<?php

use yii\helpers\Html;
use yii\grid\GridView;

use backend\models\Otchetlist;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OtchetlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Отчёты';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otchetlist-index">




<?php

$tblst = new Otchetlist();

$arr_tab = array('otchet3', 'otchetn', 'otchet9', 'otchet7', 'otchet14', 'otchet17', 'otchet19', 'otchet20');

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
