<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_images".
 *
 * @property integer $id
 * @property string $img_name
 * @property integer $blog_id
 *
 * @property Blog $blog
 */
class BlogImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_id'], 'integer'],
            [['img_name'], 'string', 'max' => 300],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'img_name' => Yii::t('app', 'Img Name'),
            'blog_id' => Yii::t('app', 'Blog ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }
}
