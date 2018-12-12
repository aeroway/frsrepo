<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Edvlerblog\Ldap;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
//class User extends \yii\base\BaseObject implements IdentityInterface
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    //public $id;
    //public $username;
    //public $password;
    public $authKey;
    //public $accessToken;
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
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $out = static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);

        if ($out === NULL) {

            $result = \Yii::$app->Ldap->user()->info($id);
            $resultKadastr = \Yii::$app->LdapKadastr->user()->info($id);

            if ($result) {

                return new static (['id' => $id, 'username' => $id, 'fio' => $result[0]['displayname'][0], 'groups' => \Yii::$app->Ldap->user()->groups($id)]);

            } elseif ($resultKadastr) {

                $out = array('id' => $id, 'username' => $id, 'fio' => $result[0]['displayname'][0], 'groups' => \Yii::$app->LdapKadastr->user()->groups($id));

                return new static ($out);

            } else {

                $out = new static (null);

            }
        }
        
        return $out;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        /*
        foreach (self::$users as $user)
        {
            if ($user['accessToken'] === $token) 
            {
                return new static($user);
            }
        }
        */
        //return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $out = static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);

        if ($out === NULL) {

            $result = \Yii::$app->Ldap->user()->info($username);
            $resultKadastr = \Yii::$app->LdapKadastr->user()->info($username);

            if ($result) {

                $out = array('id' => $username, 'username' => $username, 'fio' => $result[0]['displayname'][0], 'groups' => \Yii::$app->Ldap->user()->groups($username));

                return new static($out);

            } elseif ($resultKadastr) {

                $out = array('id' => $username, 'username' => $username, 'fio' => $result[0]['displayname'][0], 'groups' => \Yii::$app->LdapKadastr->user()->groups($username));

                return new static ($out);

            } else {

                $out = new static (null);

            }
        }

        return $out;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
/*
    public function getId()
    {
        return $this->id;
    }
*/

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
/*
    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
*/

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
/*
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
*/

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function checkGroup($username,$group)
    {
        return \Yii::$app->Ldap->user()->inGroup($username, $group) ? true : false;
    }

}
