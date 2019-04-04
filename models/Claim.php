<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "claim".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_id
 * @property int $user_id
 * @property string $status
 * @property string $photo_before
 * @property string $photo_after
 * @property string $created_at
 *
 * @property Category $category
 * @property User $user
 */
class Claim extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'claim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, bmp'],
            [['name', 'description', 'category_id','image'], 'required'],
            [['description'], 'string'],
            [['category_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'status', 'photo_before', 'photo_after'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'photo_before' => 'Photo Before',
            'photo_after' => 'Photo After',
            'created_at' => 'Created At',
        ];
    }

    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), [
            'image' => 'image'
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeValidate()
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {

        $filename = uniqid() . '.' . $this->image->extension;
        $this->image->saveAs('img/' . $filename);
        $this->photo_before = $filename;

        $this->user_id = Yii::$app->user->identity->id;
        $this->status = 'Новая';

        return parent::beforeSave($insert);
    }
}
