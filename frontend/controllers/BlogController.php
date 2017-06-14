<?php


namespace frontend\controllers;


use common\models\Blog;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class BlogController extends Controller
{
    public function actionIndex()
    {

        $model = Blog::find();


        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $model->count(),

        ]);
        $model->orderBy(["id" => SORT_DESC]);
        $model->joinWith("blogImages");

        $model->groupBy("blog.id");
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
        $getRequest = \Yii::$app->request->get();
        $model = null;
        if (!empty($getRequest['slug'])) {
            $model = Blog::find()
                ->joinWith("blogImages")
                ->where(['slug' => $getRequest['slug']])
                ->asArray()
                ->one();
        }

        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render("details", ['model' => $model]);

    }

}