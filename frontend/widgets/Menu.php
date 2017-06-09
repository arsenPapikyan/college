<?php
/**
 * Created by PhpStorm.
 * User: Arsen
 * Date: 08/06/2017
 * Time: 23:53
 */

namespace frontend\widgets;


use yii\base\Widget;
use common\models\Menu as modelMenu;

class Menu extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = modelMenu::find()->asArray()->all();

        return $this->render("menu", [
            'model' => $model
        ]);
    }

}