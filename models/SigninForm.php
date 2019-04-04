<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.04.2019
 * Time: 12:46
 */

namespace app\models;


use yii\base\Model;

class SigninForm extends Model
{
    public $login;
    public $password;
    public function rules()
    {
        return [
            [['login','password'],'string'],
            [['login','password'],'required'],
        ];
    }
    public function signin(){
        $user = User::find()->where(['login' => $this->login, 'password' => $this->password])->one();
        if($user){
            \Yii::$app->user->login($user);
            return $user;
        }
        $this->addError('login','Неправильный логин...');
        $this->addError('password','...или пароль');
        return false;
    }
}