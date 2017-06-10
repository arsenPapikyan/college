<?php


namespace frontend\controllers;


use common\models\Blog;
use yii\web\Controller;
use yii\data\Pagination;

class BlogController extends Controller
{
    public function actionIndex()
    {

        $model = Blog::find()
            ->joinWith("blogImages");


        $pagination = new Pagination([
            'defaultPageSize' => 9,
            'totalCount' => $model->count(),

        ]);

        $content = $model
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();
        return $this->render('index', [
            'pagination' => $pagination,
            'content' => $content
        ]);


    }

    public function actionDetails()
    {
        return $this->render("details");

    }

}