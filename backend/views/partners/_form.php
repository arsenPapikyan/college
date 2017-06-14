<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Partners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partners-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12">
        <div class="row">

            <div class="col-xs-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6">
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12">


        <?php
        $uploadUrl = Url::to(['/partners/upload-file?id=' . $model->id]);
        $deleteUrl = Url::to(["/partners/delete-file?id=" . $model->id]);
        $imagesOptions = [];
        $imgPath = [];
        if (!$model->isNewRecord) {
            $imgPath[] = Url::to('/advanced/frontend/web/images/partners/') . $model->img_name;
            $size = 0;
            if (file_exists(Yii::getAlias("@frontend") . "/web/images/partners/" . $model->img_name)) {

                $size = filesize(Yii::getAlias("@frontend") . "/web/images/partners/" . $model->img_name);
            }

            $imagesOptions[] = [
//                'caption' => $model->title,
                'url' => $deleteUrl,
                'size' => $size,
                'key' => $model->id,

            ];
        }

        ?>
        <?= $form->field($model, 'img_name')->widget(FileInput::classname(), [
            'attribute' => 'img_name',
            'name' => 'img_name',
            'options' => [
                'accept' => 'image/*',
                'multiple' => false,
            ],
            'pluginOptions' => [
                'previewFileType' => 'image',
                "uploadAsync" => true,
                'showPreview' => true,
                'showUpload' => $model->isNewRecord ? false : true,
                'showCaption' => false,
                'showDrag' => false,
                'uploadUrl' => $uploadUrl,
                'initialPreviewConfig' => $imagesOptions,
                'initialPreview' => $imgPath,
                'initialPreviewAsData' => true,
                'initialPreviewShowDelete' => true,
                'overwriteInitial' => true,
                'resizeImages' => true,
                'layoutTemplates' => [
                    !$model->isNewRecord ?: 'actionUpload' => '',

                ],
            ],
        ]); ?>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
