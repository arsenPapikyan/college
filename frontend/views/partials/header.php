<?php


?>
<div class="container-fluid">
<header>
    <?php
    if (Yii::$app->controller->id == "main" && Yii::$app->controller->action->id == "index") {
        ?>
        <div class="row">
            <div data-jarallax='{"speed": 0.1}' class='jarallax'
                 style='background-image: url(<?= Yii::$app->homeUrl ?>images/books.jpg); height: 40em; width: 100%'>
                <div class="col-xs-4">

                    Logo
                </div>
                <div class="col-xs-8">
                    <div class="row">
                        <nav>
                            <?= \yii\bootstrap\Nav::widget([
                                'options' => ['class' => 'navbar-nav', 'id' => 'main-menu'],
                                'encodeLabels' => false,
                                'activateParents' => true,
//        'lastItemCssClass'=>"dropdown",

//        'activeCssClass'=>'active',
                                'items' => \common\models\Menu::viewMenuItems(),
                            ]);
                            ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>

        <div class="col-xs-3">Logo</div>
        <div class="col-xs-8">
            <nav class="text-center">
                <?= \yii\bootstrap\Nav::widget([
                    'options' => ['class' => 'navbar-nav', 'id' => 'main-menu'],
                    'encodeLabels' => false,
                    'activateParents' => true,
//        'lastItemCssClass'=>"dropdown",

//        'activeCssClass'=>'active',
                    'items' => \common\models\Menu::viewMenuItems(),
                ]);
                ?>
            </nav>
        </div>
        <?php

    }
    ?>


</header>
</div>