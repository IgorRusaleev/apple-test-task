<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Class RegistrationForm
 * @package frontend\models
 */
class RegistrationForm extends Model
{
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'safe'],
            [['email', 'password'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => User::class],
            [['password'], 'string', 'min' => 8],
        ];
    }

    /**
     * @return false|User
     * @throws \yii\base\Exception
     */
    public function createUser()
    {
        $user = new User();
        $user->email = $this->email;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);

        if (!$user->save()) {
            return false;
        }

        return $user;
    }
}