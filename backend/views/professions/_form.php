<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\Menu;
use common\models\Pages;

/* @var $this yii\web\View */
/* @var $model common\models\Professions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="professions-form">

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


        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">

                <?php

                $slug = ArrayHelper::map(Pages::find()
                    ->select("slug,title")
                    ->asArray()
                    ->all(), "slug", "title"
                );
                echo $form->field($model, 'slug')->widget(Select2::classname(), [
                    'data' => $slug,
                    'options' => [
                        'placeholder' => 'Menu'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
            <div class="col-xs-6">
                <?php
                $professionId = Menu::find()
                    ->select("id")
                    ->where(['slug' => "profession/index"])
                    ->asArray()
                    ->one();


                $menu = ArrayHelper::map(Menu::find()
                    ->select("id,name")
                    ->where(['parent_id' => $professionId['id']])
                    ->asArray()
                    ->all(), "id", "name"
                );
                echo $form->field($model, 'menu_id')->widget(Select2::classname(), [
                    'data' => $menu,
                    'options' => [
                        'placeholder' => 'Menu'
                    ],
//                    'pluginOptions' => [
//                        'allowClear' => true
//                    ],
                ])->label("Menu") ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">


        <?php
        $uploadUrl = Url::to(['/professions/upload-file?id=' . $model->id]);
        $deleteUrl = Url::to(["/professions/delete-file?id=" . $model->id]);
        $imagesOptions = [];
        $imgPath = [];
        if (!$model->isNewRecord) {
            $imgPath[] = Url::to('/advanced/frontend/web/images/professions/') . $model->img_name;
            $size = 0;
            if (file_exists(Yii::getAlias("@frontend") . "/web/images/professions/" . $model->img_name)) {

                $size = filesize(Yii::getAlias("@frontend") . "/web/images/professions/" . $model->img_name);
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
