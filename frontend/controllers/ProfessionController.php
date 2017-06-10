<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 10/06/2017
 * Time: 14:54
 */

namespace frontend\controllers;


use yii\web\Controller;

class ProfessionController extends Controller
{

    public function actionIndex()
    {
        return $this->render("index");
    }

    public function action9YearEducationPlan()
    {

        return $this->render("9-year-education-plan");
    }

    public function action12YearEducationPlan()
    {

        return $this->render("12-year-education-plan");
    }

    public function actionInitialVocationalEducationProgram()
    {

        return $this->render("initial-vocational-education-program");
    }

}