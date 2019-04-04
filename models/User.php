<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fio
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $is_admin
 *
 * @property Claim[] $claims
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
//        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
//        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
//        return $this->authKey === $authKey;
    }
    
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
            [['is_admin'], 'integer'],
            [['fio'], 'string', 'max' => 100],
            [['login', 'email', 'password'], 'string', 'max' => 255],
            [['login'], 'unique'],
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
            'fio' => 'Fio',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
            'is_admin' => 'Is Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaims()
    {
        return $this->hasMany(Claim::className(), ['user_id' => 'id']);
    }

    public function getShortName(){
        $exploded = explode(' ', $this->fio);
        return $exploded[0].' '.mb_substr($exploded[1],0,1,'UTF-8').'. '.mb_substr($exploded[1],0,1,'UTF-8').'.';
    }
}
