<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fam',
            'name',
            'otch',
            'pasp_s',
            'pasp_n',
            'pasp_date_v',
            'pasp_kem_v',
            'adres_f',
            'adres_reg',
            'date_priem',
            'gsdp_y',
            'gsdp_m',
            'gsdp_d',
            'otsdp_y',
            'otsdp_m',
            'otsdp_d',
            'ver',
            'is_top',
            'date_nazn',
            'idm_otdel',
            'idm_doljn',
            'oklad',
            'nadbavka',
            'osnovanie',
            'date_in',
            'brak',
            'suprug',
            'phone',
            'prikazi',
            'status',
            'data_b',
            'tgs_y',
            'tgs_m',
            'tgs_d',
            'date_stazh',
            'voen_uch',
            'voen_kom',
            'inn',
            'snils',
            'voen_zvanie',
            'stat',
            'gos_reg',
            'gos_inspect',
            'status_to',
            'foto',
            'tos_y',
            'tos_m',
            'tos_d',
            'pol',
            'doplata_ur_percent',
            'doplata_ur_prikaz',
            'doplata_ur_data',
            'nadbavka_stazh',
            'nadbavka_stazh_raschet',
            'login_upr',
            'login_just',
            'check_is_login',
            'skud_card_num',
            'date_uvolnen',
        ],
    ]) ?>

</div>
