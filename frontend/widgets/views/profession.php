<?php
$homeUrl = Yii::$app->homeUrl;
/**
 * @var $model \common\models\Menu
 */
if (!empty($profession)) {
    ?>
    <div class="col-xs-12 ">
        <div class="row">
            <!--   title  -->

            <div class="col-xs-12 title">
                <h2 class="text-center"><?= $profession['name'] ?></h2>
            </div>

            <!--   content -->
            <div class="col-xs-12 contentProfession">
                <div class="row">

                    <?php
                    foreach ($model as $val) {
                        ?>
                        <div class="col-sm-3">
                            <a href="<?= $homeUrl ?><?= $val['slug'] ?>">

                                <img src="<?= $homeUrl ?>images/img_profession.jpg" class="img-responsive img-circle"
                                     alt="9 ամյա կրթական ծրագրով">
                                <p>
                                    <?= $val['name'] ?>
                                </p>
                            </a>
                        </div>
                        <?php
                    }
                    ?>


                </div>
            </div>


        </div>
    </div>
    <?php

}
?>