<?php


namespace frontend\widgets;


use yii\base\Widget;
use common\models\Menu;

class Profession extends Widget
{
    public function init()
    {
        parent::init();
    }


    public function run()
    {
        $profession = Menu::find()
            ->select("id,name")
            ->where([
                'slug' => "profession/index"
            ])->asArray()
            ->one();

        $model = Menu::find()
            ->where([
                'parent_id' => $profession['id'],
                'is_status' => 1
            ])->asArray()
            ->all();


        return $this->render("profession", [
            'model' => $model,
            'profession' => $profession
        ]);
    }

}