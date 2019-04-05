<?php
use yii\helpers\Url;
$this->title = 'Мои заявки'
?>

<div class="site-myclaims container">
    <h1>Мои заявки</h1>
    <div class="row">
        <?php foreach($claims as $claim): ?>
            <div class="">
                <a href="<?= Url::to(['site/claim', 'id'=>$claim->id]) ?>">
                    <div class="col-md-12 card">
                        <h3><?= $claim->name ?> <a href="<?= Url::to(['site/remove', 'id' => $claim->id]) ?>" class="remove-claim"><span class="glyphicon glyphicon-remove"></span></a></h3>
                        <h4><?= $claim->description ?></h4>
                        <p class="claim-category"><?= Yii::$app->formatter->asDate($claim->created_at) ?> - <?= $claim->category->name ?> <span class="badge"><?= $claim->status ?></span></p>
                        <div class="photo">
                            <div class="photoBefore"><img src="/img/<?= $claim->photo_before ?>" alt="<?= $claim->name ?> before"></div>
                            <?php if($claim->photo_after): ?>
                                <div class="photoAfter"><img src="/img/<?= $claim->photo_after ?>" alt="<?= $claim->name ?> after"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>
