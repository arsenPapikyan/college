<nav>
    <ul>
        <?php
        $homeUrl = Yii::$app->homeUrl;
        if (!empty($model)) {

            foreach ($model as $val) {
                ?>
                <li>
                    <a href=" <?= $homeUrl ?><?= $val['slug'] ?>"><?= $val['name'] ?></a>
                </li>
                <?php

            }
        }

        ?>
    </ul>
</nav>