<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use yii\helpers\Url;
use yii\redactor\widgets\Redactor;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $modelImages common\models\BlogImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>
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

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>


    <div class="col-xs-12">
        <?= $form->field($model, 'short_text')->widget(Redactor::className(),
            [
                'clientOptions' =>
                    [
                        'imageUpload' => Url::to(['/redactor/upload/image']),
                        'fileUpload' => false,
                        'plugins' => ['fontcolor', 'imagemanager', 'table', 'undoredo', 'clips', 'fullscreen'],
                    ]
            ]) ?>
    </div>
    <div class="col-xs-12">
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

    <div class="col-xs-12">
        <?php


        $uploadUrl = Url::to(['/blog/upload-file?id=' . $model->id]);
        $imagesOptions = [];
        $imgPath = [];
        $size = 0;


        //        $imgPath[] = Url::to('/advanced/frontend/web/images/blog/') . $model->img_name;
        //        $size = 0;
        //        if (file_exists(Yii::getAlias("@frontend") . "/web/images/blog/" . $model->img_name)) {
        //
        //        $size = filesize(Yii::getAlias("@frontend") . "/web/images/blog/" . $model->img_name);
        //        }

        if (!$model->isNewRecord) {

            foreach ($imgData as $val) {

                $deleteUrl = Url::to(["/blog/delete-file?id=" . $val['id']]);

                if (file_exists(Yii::getAlias("@frontend") . "/web/images/blog/" . $val['img_name'])) {

                    $size = filesize(Yii::getAlias("@frontend") . "/web/images/blog/" . $val['img_name']);


                    $imgPath[] = Url::to('/advanced/frontend/web/images/blog/') . $val['img_name'];

                }
                $imagesOptions[] = [
                    //                'caption' => $model->title,
                    'url' => $deleteUrl,
                    'size' => $size,
                    'key' => $val['id'],

                ];
            }
        }


        ?>
        <?= $form->field($modelImages, 'img_name[]')->widget(FileInput::classname(), [
            'attribute' => 'img_name[]',
            'name' => 'img_name[]',
            'options' => [
                'accept' => 'image/*',
                'multiple' => true,

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
                'overwriteInitial' => $model->isNewRecord ? true : false,
                'resizeImages' => true,
                'layoutTemplates' => [
                    !$model->isNewRecord ?: 'actionUpload' => '',
//               count($model->newsImages) != 1 ?: 'actionDelete' => '',

                ],
            ],
        ]);
        ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
