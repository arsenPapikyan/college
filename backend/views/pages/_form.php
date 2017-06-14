<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\redactor\widgets\Redactor;
use yii\helpers\Url;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12">
        <?= $form->field($model, 'is_active')->widget(SwitchInput::classname(), [
            'value' => true,
            'pluginOptions' => [
                'size' => 'large',
                'onColor' => 'success',
                'offColor' => 'danger',
                'onText' => 'Active',
                'offText' => 'Inactive'
            ]
        ]) ?>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">

                    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>

            </div>
            <div class="col-xs-6">

                    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
                </div>

        </div>
    </div>

    <div class="col-xs-12">
        <div class="row">

            <?= $form->field($model, 'content')->widget(Redactor::className(),
                [
                    'clientOptions' =>
                        [
                            'imageUpload' => Url::to(['/redactor/upload/image']),
                            'fileUpload' => false,
                            'plugins' => ['fontcolor', 'imagemanager', 'table', 'undoredo', 'clips', 'fullscreen'],
                        ]
                ]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
