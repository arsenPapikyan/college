<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 10/06/2017
 * Time: 14:54
 */

namespace frontend\controllers;


use common\models\Menu;
use common\models\Professions;
use yii\web\Controller;

class ProfessionController extends Controller
{

    public function actionIndex()
    {
        return $this->render("index");
    }

    public function action9YearEducationPlan()
    {
        $slug = "profession/9-year-education-plan";

        $model = $this->getProfessionsModel($slug);


        return $this->render("9-year-education-plan", [
            'model' => $model
        ]);
    }

    public function action12YearEducationPlan()
    {
        $slug = "profession/12-year-education-plan";

        $model = $this->getProfessionsModel($slug);

        return $this->render("12-year-education-plan", [
            'model' => $model
        ]);
    }

    public function actionInitialVocationalEducationProgram()
    {
        $slug = "profession/initial-vocational-education-program";

        $model = $this->getProfessionsModel($slug);

        return $this->render("initial-vocational-education-program", [
            'model' => $model
        ]);
    }

    private function getProfessionsModel($slug)
    {
        $getMenuId = Menu::find()
            ->select("id")
            ->where(['slug' => $slug])
            ->asArray()
            ->one();
        return Professions::find()
            ->where(['menu_id' => $getMenuId['id']])
            ->asArray()
            ->all();
    }

}