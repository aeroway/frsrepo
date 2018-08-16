<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add permission "editMfc"
        $editMfc = $auth->createPermission('editMfc');
        $editMfc->description = 'Can do actions like a MFC user';
        $auth->add($editMfc);

        // add permission "editZkp"
        $editZkp = $auth->createPermission('editZkp');
        $editZkp->description = 'Can do actions like a ZKP user';
        $auth->add($editZkp);

        // add role "mfc" and give it permission "editMfc"
        $mfc = $auth->createRole('mfc');
        $auth->add($mfc);
        $auth->addChild($mfc, $editMfc);

        // add role "zkp" and give it permission "editZkp"
        $zkp = $auth->createRole('zkp');
        $auth->add($zkp);
        $auth->addChild($zkp, $editZkp);

        // set the role for users
        $auth->assign($mfc, 13);
    }
}