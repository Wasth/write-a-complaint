<div class="site-claim container">
    <h1><?= $claim->name ?></h1>
    <h3><?= $claim->description ?></h3>
    <div class="photo">
        <div class="photoBefore"><img src="/img/<?= $claim->photo_before ?>" alt="<?= $claim->name ?> before"></div>
        <?php if($claim->photo_after): ?>
        <div class="photoAfter"><img src="/img/<?= $claim->photo_after ?>" alt="<?= $claim->name ?> after"></div>
        <?php endif; ?>
    </div>
</div>