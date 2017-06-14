<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use common\models\Pages;
use kartik\widgets\Select2;
use common\models\Menu;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12">
        <?= $form->field($model, 'is_status')->widget(SwitchInput::classname(), [
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
            <div class="col-xs-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-6">

                <?php
                $data = null;
                if ($model->isNewRecord) {
                    $data = ArrayHelper::map(Menu::find()
                        ->select("id,name")
                        ->asArray()
                        ->all(), "id", "name"
                    );
                }else{

                    $data = ArrayHelper::map(Menu::find()
                        ->select("id,name")
                        ->where(['!=', "id", $model->id])
                        ->asArray()
                        ->all(), "id", "name"
                    );
                }
                echo $form->field($model, 'parent_id')->widget(Select2::classname(), [
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'parent_id'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12">

        <?php
        if ($model->isNewRecord) {

            $slug = ArrayHelper::map(Pages::find()
                ->select("slug,title")
                ->asArray()
                ->all(), "slug", "title"
            );
            echo $form->field($model, 'slug')->widget(Select2::classname(), [
                'data' => $slug,
                'options' => [
                    'placeholder' => 'Slug'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        }
        ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
