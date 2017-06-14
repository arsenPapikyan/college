<?php
/**
 * @var $model \common\models\Pages
 */
$this->title = $model['title'];
$this->registerMetaTag(['name' => 'keywords', 'content' => $model['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $model['description']]);
?>

<div class="container">
    <div class="row">
        <div class="text-center titlePages">
            <h2><?= $model['title'] ?></h2>
        </div>
        <br>
        <div>
            <?= $model['content'] ?>
        </div>
    </div>
</div>