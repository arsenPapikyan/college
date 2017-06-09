<?php


namespace frontend\controllers;


use common\models\Partners;
use yii\web\Controller;

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
        return $this->render("contact");
    }
}