<?php

namespace c006\widget\banner\models;

use Yii;

/**
 * This is the model class for table "widget_banner_items".
 *
 * @property integer $id
 * @property integer $banner_id
 * @property string $name
 * @property string $url
 * @property integer $date_start
 * @property integer $date_start_hour
 * @property integer $date_end
 * @property integer $date_end_hour
 * @property integer $file_id
 * @property string $alt_text
 * @property integer $pause
 */
class WidgetBannerItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget_banner_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner_id', 'name', 'date_start', 'date_start_hour', 'date_end', 'date_end_hour', 'file_id'], 'required'],
            [['banner_id', 'date_start_hour', 'date_end_hour', 'file_id', 'pause'], 'integer'],
            [['name', 'url'], 'string', 'max' => 100],
            [['alt_text'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'              => Yii::t('app', 'ID'),
            'banner_id'       => Yii::t('app', 'Banner'),
            'name'            => Yii::t('app', 'Name'),
            'url'             => Yii::t('app', 'Url'),
            'date_start'      => Yii::t('app', 'Date Start'),
            'date_start_hour' => Yii::t('app', 'Date Start Hour'),
            'date_end'        => Yii::t('app', 'Date End'),
            'date_end_hour'   => Yii::t('app', 'Date End Hour'),
            'file_id'         => Yii::t('app', 'File'),
            'alt_text'        => Yii::t('app', 'Alt Text'),
            'pause'           => Yii::t('app', 'Pause'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(WidgetBanner::className(), ['id' => 'banner_id']);
    }
}
