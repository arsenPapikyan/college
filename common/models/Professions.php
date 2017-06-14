<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "professions".
 *
 * @property integer $id
 * @property string $title
 * @property string $img_name
 * @property string $slug
 * @property integer $menu_id
 *
 * @property Menu $menu
 */
class Professions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'professions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id'], 'integer'],
            [['title', 'img_name', 'slug'], 'string', 'max' => 300],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'img_name' => Yii::t('app', 'Img Name'),
            'slug' => Yii::t('app', 'Slug'),
            'menu_id' => Yii::t('app', 'Menu ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }
}
