<?php
use yii\widgets\LinkPager;

/**
 * @var $content
 * @var $pagination
 */

if (!empty($content)) {
    $homeUrl = Yii::$app->homeUrl;
    ?>

    <div class="container">
        <div class="row">

            <div class="col-xs-12 ">
                <div class="row ">
                    <?php

                    foreach ($content as $val) {
                        ?>
                        <div class="col-xs-6 col-sm-4">
                            <div class="row">
                                <a href="<?= $homeUrl ?>blog/details/<?= $val['slug'] ?>">
                                    <img src="<?= $homeUrl ?>images/blog/<?= $val['blogImages'][0]["img_name"]?>"
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

            <div class="col-xs-12 ">
                <div class="row pull-right">

                    <?php
                    echo LinkPager::widget([
                        'pagination' => $pagination,
                        'hideOnSinglePage' => true,
                        'registerLinkTags' => true,
                        'linkOptions' => [
                            'class' => 'filterCategoryMenu',
                        ],

                    ]);

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>