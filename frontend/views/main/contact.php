<?php
use yii\widgets\ActiveForm;

/**
 * @var $model  \frontend\models\ContactForm
 */
?>
<div class="container">
    <div class="row">


        <?php
        $form = ActiveForm::begin([
            'options' => [
                'role' => false,
            ]
        ]); ?>

        <div class="col-xs-12 col-sm-6 col-md-6 contact_form">
            <div class="row">


                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, "name")->textInput(["placeholder" => "Имя и Фамилия"])->label(false) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, "email")->textInput(["placeholder" => "Электронная почта"])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <?= $form->field($model, "body")->textarea(['class' => "form-control contact__textarea", "value" => "Письмо"])->label(false) ?>
                </div>

                <div class="col-xs-12">

                    <input type="submit" class="btn btn-default contact_btn" name="ContactForm[submit]"
                           value="Отправить">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 contact__info_colBlog">
            <div class="contact__info_blog">

                <p>
                    <span class="fa fa-map-marker   contact__info_icon" aria-hidden="true"></span>
                    <a href="#" class="contact_info_fin_link"><?= $contact['address'] ?></a>
                </p>
                <p>
                    <span class="fa fa-phone contact__info_icon" aria-hidden="true"></span>
                    <a href="#" class="contact_info_fin_link"><?= $contact['phone'] ?></a>
                </p>
                <p>
                    <span class="fa fa-envelope-o contact__info_icon" aria-hidden="true"></span>
                    <a href="#" class="contact_info_fin_link"> <?=$contact['email']?>                 </a>
                </p>
            </div>
            <span class="triger_info"></span>
        </div>


        <?php $form::end();

        ?>
    </div>
</div>
<!-- for map -->
<div id="map"></div>
