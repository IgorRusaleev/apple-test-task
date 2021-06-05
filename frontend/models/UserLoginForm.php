<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Class UserLoginForm
 * @package frontend\models
 */
class UserLoginForm extends Model
{
    public $password;
    public $email;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['password'], 'required', 'on' => 'default'],
            [['email', 'password'], 'required', 'on' => 'loginWithEmail'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    /**
     * @param $attribute
     */
    public function validatePassword($attribute): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный email или пароль.');
            }
        }
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    /**
     * @return string[]
     */
    public function attributeLabels(): array
    {
        return [
            'email' => 'Емайл',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

    /**
     * @return bool
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }
}