<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.04.2019
 * Time: 12:46
 */

namespace app\models;


use yii\base\Model;

class SignupForm extends Model
{
    public $fio;
    public $login;
    public $email;
    public $password;
    public $passwordRepeat;
    public $consent;

    public function rules()
    {
        return [
            [['fio', 'login', 'email', 'password', 'passwordRepeat', 'consent'], 'required'],
            [['fio', 'login', 'email', 'password', 'passwordRepeat', 'consent'], 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['login', 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'login'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
            ['consent', 'boolean'],
            ['fio', 'validateFio'],
            ['consent', 'validateConsent'],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function validateFio(){
        if(!preg_match('/^[а-яА-Я]+ [а-яА-Я]+ [а-яА-Я]+$/u', $this->fio)){
            $this->addError('fio', 'Укажите данные в формате "Фамилия Имя Отчество"');
        }
    }

    public function validateConsent(){
        if($this->consent != 1){
            $this->addError('consent', 'Вы должны согласиться на обработку данных');
        }
    }

    public function signup(){
        $user = new User();
        $user->load($this->attributes,'');
        $user->save();
        \Yii::$app->user->login($user);
    }
}