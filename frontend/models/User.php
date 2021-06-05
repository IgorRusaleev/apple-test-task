<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $password_hash
 * @property string $email
 * @property int $created_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_hash', 'email'], 'required'],
            [['created_at'], 'integer'],
            [['password_hash', 'email'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Находит пользователя по емайл
     * @param $email
     * @return User|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @param string $authKey
     * @return null
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param int $idUser
     * @return User|IdentityInterface|null
     */
    public function getUser(int $idUser)
    {
        return self::findIdentity($idUser);
    }
}
