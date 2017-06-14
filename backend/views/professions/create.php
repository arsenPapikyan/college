<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Professions */

$this->title = Yii::t('app', 'Create Professions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Professions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
