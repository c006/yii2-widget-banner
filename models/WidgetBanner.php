<?php

namespace c006\widget\banner\models;

use Yii;

/**
 * This is the model class for table "widget_banner".
 *
 * @property integer $id
 * @property string $name
 * @property integer $width
 * @property integer $height
 * @property integer $transition_id
 * @property integer $transition_type_id
 * @property integer $transition_time
 * @property string $css
 * @property integer $active
 */
class WidgetBanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'width', 'height'], 'required'],
            [['transition_id', 'transition_type_id', 'transition_time', 'active', 'width', 'height'], 'integer'],
            [['css'], 'string'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                 => Yii::t('app', 'ID'),
            'name'               => Yii::t('app', 'Name'),
            'width'              => Yii::t('app', 'Width'),
            'height'             => Yii::t('app', 'Height'),
            'transition_id'      => Yii::t('app', 'Transition ID'),
            'transition_type_id' => Yii::t('app', 'Transition Type ID'),
            'transition_time'    => Yii::t('app', 'Transition Time'),
            'css'                => Yii::t('app', 'Css'),
            'active'             => Yii::t('app', 'Active'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerTransitionTypes()
    {
        return $this->hasOne(WidgetBannerTransitionTypes::className(), ['id' => 'transition_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerTransitions()
    {
        return $this->hasOne(WidgetBannerTransitions::className(), ['id' => 'transition_id']);
    }
}
