<?php

namespace common\models;

use Edvlerblog\Ldap;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $fio;
    public $groups;

/*
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
        '102' => [
            'id' => '102',
            'username' => 'user',
            'password' => 'user',
            'authKey' => 'test102key',
            'accessToken' => '102-token',
        ],
    ];
*/

    /**
     * @inheritdoc
     */

    public static function findIdentity($id)
    {
        $result = \Yii::$app->Ldap->user()->info($id);
        if ($result)
        {
            $out=array('id'=>$id,'username'=>$id,'fio'=>$result[0]['displayname'][0],'groups'=>\Yii::$app->Ldap->user()->groups($id));
        } else 
        {
            $out = null; 
        }

        return new static ($out);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user)
        {
            if ($user['accessToken'] === $token) 
            {
                return new static($user);
            }
        }

        return null;
    }


    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */

    public static function findByUsername($username)
    {
        $result = \Yii::$app->Ldap->user()->info($username);
        $resultKadastr = \Yii::$app->LdapKadastr->user()->info($username);

        if ($result)
        {
            $out = array('id' => $username, 'username' => $username, 'fio' => $result[0]['displayname'][0], 'groups' => \Yii::$app->Ldap->user()->groups($username));

            return new static($out);
        } else if ($resultKadastr)
        {
            $out = array('id' => $username, 'username' => $username, 'fio' => $result[0]['displayname'][0], 'groups' => \Yii::$app->LdapKadastr->user()->groups($username));

            return new static($out);
        }
        
        else
        {
            die('Неверный логин или пароль');
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }


    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function checkGroup($username,$group)
    {
        return \Yii::$app->Ldap->user()->inGroup($username,$group) ? true : false;
    }

    public static function findGroup($username)
    {
        echo 'username: '.$username;
        exit();

        /*
        $result = \Yii::$app->Ldap->user()->info($id);
        if ($result)
        {
            $out = array('id' => $id, 'username' => $id, 'fio' => $result[0]['displayname'][0], 'groups' => array('1' => 1));
        }
        else
        {
            $out = null;
        }

        return new static ($out);
        */
    }
}
