<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SignupForm */
/* @var $form ActiveForm */
$this->title = 'Регистрация'
?>
<div class="site-signup container">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal',
        'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-2 text-sm-left',
            'offset' => 'col-sm-offset-2',
            'wrapper' => 'col-sm-4',
        ],
        ],]); ?>

        <?= $form->field($model, 'fio') ?>
        <?= $form->field($model, 'login') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'passwordRepeat')->passwordInput() ?>
        <?= $form->field($model, 'consent')->checkbox()->label('Согласие на обработку персональных данных') ?>
    
        <div class="form-group col-sm-6 text-right">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-signup -->
