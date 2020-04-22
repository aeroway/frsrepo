<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VupiskiDogovorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vupiski Dogovors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vupiski-dogovor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vupiski Dogovor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'pr_name_f',
            'pr_name_s',
            'pr_name_l',
            'pr_date_b',
            //'pr_mesto_b',
            //'pr_pol',
            //'pr_pasp_s',
            //'pr_pasp_n',
            //'pr_vudan',
            //'pr_vudan_data',
            //'pr_adres_reg',
            //'pr_kod_podrazd',
            //'pok_name_f',
            //'pok_name_s',
            //'pok_name_l',
            //'pok_date_b',
            //'pok_mesto_b',
            //'pok_pol',
            //'pok_pasp_s',
            //'pok_pasp_n',
            //'pok_vudan',
            //'pok_vudan_data',
            //'pok_adres_reg',
            //'pok_kod_podrazd',
            //'obj_type',
            //'obj_kn',
            //'obj_adres',
            //'obj_square',
            //'obj_square_l',
            //'obj_cnt_room',
            //'obj_floor',
            //'obj_pod',
            //'dop_info',
            //'cena',
            //'doc_osn',
            //'date_doc_osn',
            //'zapis_v_egrp',
            //'date_zapis_v_egrp',
            //'svid',
            //'date_svid',
            //'_from',
            //'date_in',
            //'istochnik',
            //'ip',
            //'time_start',
            //'time_end',
            //'status',
            //'type_d',
            //'floors_dom',
            //'pod_oni',
            //'invn_oni',
            //'liter_oni',
            //'zem_oni',
            //'nazn_oni',
            //'square_oni_zu',
            //'square_oni_dom',
            //'kn_oni_dom',
            //'doc_osn_oni_dom',
            //'date_doc_osn_oni_dom',
            //'pravo_polz_zu',
            //'num_nej_pom',
            //'inv_ocenka',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
