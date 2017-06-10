<?php

namespace frontend\controllers;


use yii\web\Controller;
use common\models\Pages;
use Yii;
use yii\web\NotFoundHttpException;

class PagesController extends Controller
{
    public function actionIndex()
    {

        $getRequest = Yii::$app->request->get();

        if (isset($getRequest['slug']) && $getRequest['slug'] !== '') {
            $model = Pages::find()
                ->where([
                    'slug' => $getRequest['slug']
                ])
                ->asArray()
                ->one();

            if (!empty($model)) {
                return $this->render("index", ['model' => $model]);
            }
        }

        throw new NotFoundHttpException('The requested page does not exist.');

    }

}