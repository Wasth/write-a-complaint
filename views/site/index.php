<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Помоги городу!';
?>

<div class="jumbotron">
    <div class="container">
        <h1>Привет, дорогой друг!</h1>
        <p>
            Вместе мы сможем улучшить наш любимый город. Нам очень сложно узнать обо всех проблемах города, поэтому мы
            предлагаем тебе помочь своему городу!
        </p>
        <p>
            Увидел проблему? Дай нам знать о ней и мы ее решим!
        </p>
        <p>
            <a class="btn btn-success btn-lg" href="#" role="button">Сообщить о проблеме</a>
            <a class="btn btn-primary btn-lg" href="#" role="button">Присоедениться к проекту</a>
        </p>
    </div>
</div>

<div class="site-index container">
    <h2>Последние решенные проблемы</h2>
    <a href="/site/test">awdawd</a>
    <br>
    <div class="row">
        <?php foreach($claims as $claim): ?>
            <div class="">

                <div class="col-md-12 card">
                    <a href="<?= Url::to(['site/claim', 'id'=>$claim->id]) ?>">
                        <h3><?= $claim->name ?></h3>
                    </a>
                    <h4><?= $claim->description ?></h4>
                    <p class="claim-category"><?= Yii::$app->formatter->asDate($claim->created_at) ?> - <?= $claim->category->name ?> <span class="badge"><?= $claim->status ?></span></p>
                    <div class="photo">
                        <div class="photoBefore"><img src="/img/<?= $claim->photo_before ?>" alt="<?= $claim->name ?> before"></div>
                        <?php if($claim->photo_after): ?>
                            <div class="photoAfter" style="background-image: url('/img/<?= $claim->photo_after ?>')"><div class="circle"></div></div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>