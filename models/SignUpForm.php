<?php

namespace app\models;

use yii\base\Model;

use app\models\User;

class SignupForm extends Model {

    public $name;
    public $email;
    public $password;
    public $repeat_password;
    public $city_id;
    public $is_executor;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'repeat_password', 'city_id'], 'required'],
            [['is_executor', 'city_id'], 'integer'],
            [['name', 'email', 'password', 'repeat_password'], 'string', 'max' => 128],
            [['repeat_password'], 'compare', 'compareAttribute'=>'password'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'repeat_password' => 'Повтор пароля',
            'is_executor' => 'собираюсь откликаться на заказы',
            'city_id' => 'Город',
        ];
    }

    /**
     *
     */
    public function signup()
    {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->is_executor = $this->is_executor;
        $user->city_id = $this->city_id;
        return $user->save();
    }
}
