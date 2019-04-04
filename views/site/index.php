<?php

/* @var $this yii\web\View */

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
    <br>
    <div class="row">
        <?php foreach($claims as $claim): ?>
            <div class="col-sm-6 col-md-4">
                <div class="col-md-12 card">
                    <h3><?= $claim->name ?></h3>
                    <h4><?= $claim->description ?></h4>
                    <div class="photo">
                        <div class="photoBefore"><img src="/img/<?= $claim->photo_before ?>" alt="<?= $claim->name ?> before"></div>
                        <?php if($claim->photo_after): ?>
                            <div class="photoAfter"><img src="/img/<?= $claim->photo_after ?>" alt="<?= $claim->name ?> after"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>