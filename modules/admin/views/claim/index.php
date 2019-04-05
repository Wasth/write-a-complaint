<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClaimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Claims';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Claim', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'photo_before',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img('/img/' . $model->photo_before, ['class' => 'admin-img']);
                }
            ],
            [
                'attribute' => 'photo_after',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img('/img/' . $model->photo_after, ['class' => 'admin-img']);
                }
            ],
            'name',
//            'description:ntext',
            [
                'label' => 'Category',
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->name;
                }
            ],
            [
                'label' => 'User',
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->shortname;
                }
            ],
            //'status',
            //'photo_before',
            //'photo_after',
            //'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>


</div>
