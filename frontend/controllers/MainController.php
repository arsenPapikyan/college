<?php


namespace frontend\controllers;


use common\models\Contact;
use common\models\Partners;
use frontend\models\ContactForm;
use yii\web\Controller;
use Yii;

class MainController extends Controller
{

    public function actionIndex()
    {
        $modelPartners = Partners::find()->asArray()->all();

        return $this->render("index", [
            'modelPartners' => $modelPartners
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        $contact = Contact::find()->asArray()->one();

        if ($model->load(Yii::$app->request->post()) &&
            $model->sendEmail(Yii::$app->params['adminEmail'])
        ) {
            Yii::$app->session->setFlash('contact');
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
            'contact' => $contact,
        ]);


    }
}