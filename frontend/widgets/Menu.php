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

        echo \yii\widgets\Menu::widget([
            'options' => ['class' => 'clearfix', 'id'=>'main-menu'],
            'encodeLabels'=>false,
            'activateParents'=>true,
            'activeCssClass'=>'active',
            'items' => modelMenu::viewMenuItems(),
        ]);




        $array = [];
        $model = modelMenu::find()->asArray()->all();
        foreach ($model as $val) {
            if ($val['parent_id'] == 0) {
                $array[0][] = $val;
            } else {
                $array[$val['parent_id']][] = $val;
            }

        }
        echo "<pre>";
        var_dump($array);
        exit();

        return $this->render("menu", [
            'model' => $model
        ]);
    }

}