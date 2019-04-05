<?php
    $this->title = $claim->name;
?>
<div class="site-claim container">
    <div class="card">
        <h1><?= $claim->name ?></h1>
        <h3><span class="badge"><?= $claim->status ?></span> <?= $claim->description ?></h3>
        <h4 class="claim-category"><?= Yii::$app->formatter->asDate($claim->created_at) ?> - <?= $claim->category->name ?></h4>
        <div class="photo">
            <div class="photoBefore"><img src="/img/<?= $claim->photo_before ?>" alt="<?= $claim->name ?> before"></div>
            <?php if($claim->photo_after): ?>
                <div class="photoAfter" style="background-image: url('/img/<?= $claim->photo_after ?>')"><div class="circle"></div></div>
            <?php endif; ?>
        </div>
    </div>
</div>