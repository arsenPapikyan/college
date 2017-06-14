<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $short_text
 * @property string $content
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_active
 *
 * @property BlogImages[] $blogImages
 */
class Blog extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'title',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => true,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title',  'content'], 'required'],
            [['short_text', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['is_active'], 'integer'],
            [['title', 'keywords', 'description', 'slug'], 'string'],
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
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'short_text' => Yii::t('app', 'Short Text'),
            'content' => Yii::t('app', 'Content'),
            'slug' => Yii::t('app', 'Slug'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogImages()
    {
        return $this->hasMany(BlogImages::className(), ['blog_id' => 'id']);
    }
}
