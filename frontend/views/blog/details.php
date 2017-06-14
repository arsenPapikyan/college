<?php
$homeUrl = Yii::$app->homeUrl;

?>

<div class="container">
    <div class="row">
        <div class="title text-center">
            <h1><?= $model['title'] ?></h1>
        </div>

        <div>
            <?php
            foreach ($model['blogImages'] as $val) {
                ?>
                <img src="<?= $homeUrl ?>images/blog/<?= $val['img_name'] ?>" alt=" <?= $model['title'] ?>">
                <?php
            }
            ?>
        </div>
        <div>
            <?= $model['content'] ?>
        </div>
    </div>
</div>
