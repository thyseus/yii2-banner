<?php

namespace thyseus\banner\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $url
 * @property string $client
 * @property string $adspace
 * @property int $visit_count
 * @property string $created_at
 * @property string $updated_at
 * @property string $valid_from
 * @property string $valid_until
 * @property string $comment
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{banner}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => date('Y-m-d G:i:s'),
            ],
        ];
    }

    public function isActive()
    {
        $now = time();

        if ($this->active !== 1) {
            return false;
        }

        $valid_from = strtotime($this->valid_from);
        $valid_until = strtotime($this->valid_until);

        return $valid_from <= $now && $valid_until >= $now;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'image', 'url'], 'required'],
            [['visit_count', 'active'], 'integer'],
            [['created_at', 'updated_at', 'valid_from', 'valid_until', 'slug'], 'safe'],
            [['comment'], 'string'],
            [['url'], 'url'],
            [['title', 'slug', 'image', 'url', 'client', 'adspace'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('banner', 'ID'),
            'title' => Yii::t('banner', 'Title'),
            'slug' => Yii::t('banner', 'Slug'),
            'image' => Yii::t('banner', 'Image'),
            'url' => Yii::t('banner', 'Url'),
            'client' => Yii::t('banner', 'Client'),
            'adspace' => Yii::t('banner', 'Adspace'),
            'visit_count' => Yii::t('banner', 'Visit Count'),
            'created_at' => Yii::t('banner', 'Created At'),
            'updated_at' => Yii::t('banner', 'Updated At'),
            'valid_from' => Yii::t('banner', 'Valid From'),
            'valid_until' => Yii::t('banner', 'Valid Until'),
            'comment' => Yii::t('banner', 'Comment'),
            'active' => Yii::t('banner', 'Active'),
        ];
    }
}
