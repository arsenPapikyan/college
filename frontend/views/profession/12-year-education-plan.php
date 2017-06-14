<?php

/**
 * @var $model \common\models\Professions
 */

if (!empty($model)) {
    $homeUrl = Yii::$app->homeUrl;
    ?>
    <div class="container">
        <div class="row">
            <?php
            foreach ($model as $val) {
                ?>
                <div class="col-xs-12 col-xs-3 ">
                    <div class="row">`
                        <a href="<?= $homeUrl ?>pages/<?= $val['slug']?>">
                            <img src="<?= $homeUrl ?>images/professions/<?= $val['img_name']?>"
                                 class="img-responsive"
                                 alt="<?= $val['title']?>">
                            <p>
                                <?= $val['title']?>
                            </p>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
    <?php
}