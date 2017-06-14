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

            <?php
            $temp = 2;
            foreach ($content as $key => $val) {
                if ($key == $temp) {
                    ?>
                    <div class="row">
                    <?php

                }

                ?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div>

                        <a href="<?= $homeUrl ?>blog/details/<?= $val['slug'] ?>">
                            <img src="<?= $homeUrl ?>images/blog/200x150/<?= $val['blogImages'][0]["img_name"] ?>"
                                 class="img-responsive"
                                 alt="<?= $val['title'] ?>">
                            <p>
                                <?= $val['title'] ?>
                            </p>
                        </a>

                        <a href="<?= $homeUrl ?>blog/details/<?= $val['slug'] ?>">
                                <?= $val['title'] ?>
                        </a>
                    </div>
                </div>

                <?php
                if ($key == $temp) {
                    $temp += 3;
                    ?>
                    </div>
                    <?php

                }
//                if ($key == 2){
//                    break;
//                }

            }

            ?>



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