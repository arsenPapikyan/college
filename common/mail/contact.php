<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<h2 style="color: rgba(151, 1, 1, 0.5)">Contact </h2>
<?= $content?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
