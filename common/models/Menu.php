<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $parent_id
 * @property string $create_at
 * @property string $update_at
 * @property integer $is_status
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_status'], 'integer'],
            [['parent_id', ], 'default'],
            [['name', 'slug', 'create_at', 'update_at'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'is_status' => Yii::t('app', 'Is Status'),
        ];
    }

    private static function getMenuItems()
    {
        $items = [];
        $resultAll = self::find()->orderBy('id')->all();

        foreach ($resultAll as $val) {
            if (empty($items[$val->parent_id])) {
                $items[$val->parent_id] = [];
            }
            $items[$val->parent_id][] = $val->attributes;
        }
        return $items;
    }


    public static function viewMenuItems($parentId = 0)
    {
        $result = [];
        $arrItems = self::getMenuItems();
        if (empty($arrItems[$parentId])) {
            return null ;
        }
        foreach ($arrItems[$parentId] as $val){
            $result[] = [
                'label' => $val['name'],
                'url' => ["/".$val['slug']],
                'linkOptions' => ['title' => $val['name']],
                'items' => self::viewMenuItems($val['id']),
//                'options' => ['class' => "dropdown"],
            ];
        }

        return $result;
    }
}
