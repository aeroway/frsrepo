<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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

    /**
     * {@inheritdoc}
     */

    public static function findIdentity($username)
    {
        // $out = static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);

        // if ($out === NULL) {

        $userRosreestr = \Yii::$app->LdapRosreestr->search()->findBy('sAMAccountname', $username);
        $userKadastr = \Yii::$app->LdapKadastr->search()->findBy('sAMAccountname', $username);

        if ($userRosreestr) {

            $groups = \Yii::$app->LdapRosreestr->search()->users()->find($username)->getGroupNames(true);
            sort($groups);

            $out = [
                        'id' => $username,
                        'username' => $username,
                        'fio' => $userRosreestr->getDisplayName(),
                        'groups' => $groups
                    ];

            return new static($out);

        }

        if ($userKadastr) {

            $groups = sort(\Yii::$app->LdapKadastr->search()->users()->find($username)->getGroupNames(true));
            sort($groups);

            $out = [
                        'id' => $username,
                        'username' => $username,
                        'fio' => \Yii::$app->LdapKadastr->search()->users()->find($username)->getDisplayName(),
                        'groups' => $groups
                    ];

            return new static ($out);

        }

        $out = new static (null);

        // }

        return $out;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
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

    // public function checkGroup($username,$group)
    // {
    //     return \Yii::$app->Ldap->user()->inGroup($username, $group) ? true : false;
    // }
}