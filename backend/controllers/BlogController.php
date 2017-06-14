<?php

namespace backend\controllers;

use common\models\BlogImages;
use Imagine\Image\Box;
use Yii;
use common\models\Blog;
use backend\models\BlogControl;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogControl();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();
        $modelImages = new BlogImages();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                $imgFile = UploadedFile::getInstances($modelImages, "img_name");

                if (!empty($imgFile)) {

                    $data = [];

                    foreach ($imgFile as $key => $file) {
                        $imgName = $file->name = Yii::$app->security->generateRandomString() . '.' . $file->extension;

                      if ($file->saveAs(Yii::getAlias("@frontend") . "/web/images/blog/".$imgName)){
                          $data[$key]['img_name'] = $imgName;
                          $data[$key]['blog_id'] = $model->id;

                          /**
                           * change size image
                           */

                          $image = Image::getImagine()->open(Yii::getAlias("@frontend") . "/web/images/blog/".$imgName);

                          $width = $image->getSize()->getWidth() >= 800 ? 800 : $image->getSize()->getWidth();
                          $height = $image->getSize()->getHeight() >= 600 ? 600 : $image->getSize()->getWidth();

                          $image->thumbnail(new Box($width, $height))
                              ->save(Yii::getAlias("@frontend") . "/web/images/blog/".$imgName, ['jpeg_quality' => 70])
                              ->save(Yii::getAlias("@frontend") . "/web/images/blog/".$imgName, ['png_compression_level' => 9]);


                          $image = Image::getImagine()->open(Yii::getAlias("@frontend") . "/web/images/blog/".$imgName);

                          $width = $image->getSize()->getWidth() >= 200 ? 200 : $image->getSize()->getWidth();
                          $height = $image->getSize()->getHeight() >= 150 ? 150 : $image->getSize()->getHeight();

                          $image->thumbnail(new Box($width, $height))
                              ->save(Yii::getAlias("@frontend") . "/web/images/blog/200x150/" . $imgName, ['jpeg_quality' => 40])
                              ->save(Yii::getAlias("@frontend") . "/web/images/blog/200x150/" . $imgName, ['png_compression_level' => 9]);
                      }

                    }




                    /* insert */
                    Yii::$app->db->createCommand()
                        ->batchInsert(
                            "blog_images",
                            ["img_name", "blog_id"],
                            $data)
                        ->execute();

                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelImages' => $modelImages,
        ]);

    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelImages = $model->blogImages;

        if ($model->load(Yii::$app->request->post())) {


            $imgFile = UploadedFile::getInstances($modelImages[0], "img_name");

            if (!empty($imgFile)) {
                $path = Yii::getAlias("@frontend") . "/web/images/blog/";

                $data = [];

                foreach ($imgFile as $key => $file) {
                    $imgName = $file->name = Yii::$app->security->generateRandomString() . '.' . $file->extension;
                    $path = $path . $imgName;
                    $file->saveAs($path);

                    $data[$key]['img_name'] = $imgName;
                    $data[$key]['blog_id'] = $id;

                    /**
                     * change size image
                     */

                    $image = Image::getImagine()->open($path);

                    $width = $image->getSize()->getWidth() >= 800 ? 800 : $image->getSize()->getWidth();
                    $height = $image->getSize()->getHeight() >= 600 ? 600 : $image->getSize()->getWidth();

                    $image->thumbnail(new Box($width, $height))
                        ->save($path, ['jpeg_quality' => 70])
                        ->save($path, ['png_compression_level' => 9]);


                    $image = Image::getImagine()->open($path);

                    $width = $image->getSize()->getWidth() >= 200 ? 200 : $image->getSize()->getWidth();
                    $height = $image->getSize()->getHeight() >= 150 ? 150 : $image->getSize()->getHeight();

                    $image->thumbnail(new Box($width, $height))
                        ->save(Yii::getAlias("@frontend") . "/web/images/blog/200x150/" . $imgName, ['jpeg_quality' => 40])
                        ->save(Yii::getAlias("@frontend") . "/web/images/blog/200x150/" . $imgName, ['png_compression_level' => 9]);

                }

                /* insert */
                Yii::$app->db->createCommand()
                    ->batchInsert(
                        "blog_images",
                        ["img_name", "blog_id"],
                        $data)
                    ->execute();

            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelImages' => $modelImages[0],
            'imgData' => $modelImages,
        ]);

    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionUploadFile($id)
    {
        $model = new BlogImages();
        $imgFile = UploadedFile::getInstances($model, "img_name");
        $path = Yii::getAlias("@frontend") . "/web/images/blog/";

        $data = [];

        foreach ($imgFile as $key => $file) {
            $imgName = $file->name = Yii::$app->security->generateRandomString() . '.' . $file->extension;
            $path = $path . $imgName;
            $file->saveAs($path);

            $data[$key]['img_name'] = $imgName;
            $data[$key]['blog_id'] = $id;

            /**
             * change size image
             */

            $image = Image::getImagine()->open($path);

            $width = $image->getSize()->getWidth() >= 800 ? 800 : $image->getSize()->getWidth();
            $height = $image->getSize()->getHeight() >= 600 ? 600 : $image->getSize()->getWidth();

            $image->thumbnail(new Box($width, $height))
                ->save($path, ['jpeg_quality' => 70])
                ->save($path, ['png_compression_level' => 9]);


            $image = Image::getImagine()->open($path);

            $width = $image->getSize()->getWidth() >= 200 ? 200 : $image->getSize()->getWidth();
            $height = $image->getSize()->getHeight() >= 150 ? 150 : $image->getSize()->getHeight();

            $image->thumbnail(new Box($width, $height))
                ->save(Yii::getAlias("@frontend") . "/web/images/blog/200x150/" . $imgName, ['jpeg_quality' => 40])
                ->save(Yii::getAlias("@frontend") . "/web/images/blog/200x150/" . $imgName, ['png_compression_level' => 9]);

        }

        /* insert */
        Yii::$app->db->createCommand()
            ->batchInsert(
                "blog_images",
                ["img_name", "blog_id"],
                $data)
            ->execute();

        return true;
    }

    public function actionDeleteFile($id)
    {
        if (($model = BlogImages::findOne($id)) !== null) {
            $path = Yii::getAlias("@frontend") . "/web/images/blog/";
            if (file_exists($path . $model['img_name'])) {
                unlink($path . $model['img_name']);
            }
            if (file_exists($path . "200x150/" . $model['img_name'])) {
                unlink($path . "200x150/" . $model['img_name']);

            }
            $model->delete();
        }


        return true;
    }
}
