<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SigninForm */
/* @var $form ActiveForm */
$this->title = 'Вход в городской портал';
?>
<div class="site-signin container">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2 text-sm-left',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-4',
            ],
        ],]); ?>

        <?= $form->field($model, 'login') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group col-sm-6 text-right">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-signin -->
