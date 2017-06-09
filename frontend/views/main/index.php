<div class="container">
    <div class="row">
        <?php
        /* path  */
        $homeUrl = Yii::$app->homeUrl;


        if (!empty($modelPartners)) {
            ?>

            <div class="col-xs-12 partners">
                <div class="row">

                    <div class="titlePartners">
                        <h2 class="text-center"> Մեր գործընկերները</h2>
                    </div>


                    <?php

                    foreach ($modelPartners as $val) {
                        ?>
                        <div class="col-xs-2">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="<?= $val['link'] ?>" target="_blank">
                                        <img src="<?= $homeUrl ?>images/partners/<?= $val['img_name'] ?>"
                                             class="img-responsive" alt="<?= $val['title'] ?>">
                                    </a>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <a href="<?= $val['link'] ?>" target="_blank"><?= $val['title'] ?> </a>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>