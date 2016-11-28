<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use backend\models\Otchett;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Управление Росреестра по Краснодарскому краю',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Статистика', 'url' => ['/site/stat']],
                ['label' => 'Отчёты', 'url' => ['/site/index']],
                /*
                ((Yii::$app->user->identity) && (in_array('alvl3',Yii::$app->user->identity->groups))) ?  ['label' => 'Ведомости', 'url' => ['/site2/index']] : '',
                ((Yii::$app->user->identity) && (in_array('ITUchet',Yii::$app->user->identity->groups))) ? ['label' => 'ОИТ', 'url' => ['inventory/index']] : '', 
                ((Yii::$app->user->identity) && (in_array('AccountBlockingAdmin',Yii::$app->user->identity->groups))) ? ['label' => 'Аккаунты', 'url' => ['/abemployee/index']] : '',
                ((Yii::$app->user->identity) && 
                    (
                        (in_array('alvl1',Yii::$app->user->identity->groups)) or 
                        (in_array('alvl2',Yii::$app->user->identity->groups)) or 
                        (in_array('alvl3',Yii::$app->user->identity->groups)) or 
                        (in_array('alvl4',Yii::$app->user->identity->groups)) 
                    )
                ) ? ['label' => 'Заказ дел', 'url' => ['/req/index']] : '',
                */
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => 'Сервисы', 'url' => Yii::$app->urlManagerFrontEnd->createUrl("index.php")];
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?php
        if(!empty($this->params['breadcrumbs']))
        {
            for($i=0; count($this->params['breadcrumbs']) >= $i; $i++)
            {
                if(isset($this->params['breadcrumbs'][$i]["url"]))
                {
                    $this->params['breadcrumbs'][$i]["url"]["table"] = Otchett::$name;
                }
            }
        }
        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Росреестр <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
    <script>
        $( ".field-req-scan_doc" ).hide();
        $('#req-type').change(function() {
            var select = $(this).val();
            if ( select == '5' ) {
                $( ".field-req-scan_doc" ).show();
            } else {
                $('#req-scan_doc').val('');
                $( ".field-req-scan_doc" ).hide();
            }
        });
    </script>
</html>
<?php $this->endPage() ?>
