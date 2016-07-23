<?php

namespace c006\widget\banner\models;

use Yii;

/**
 * This is the model class for table "widget_banner_transitions".
 *
 * @property integer $id
 * @property string $name
 */
class WidgetBannerTransitions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget_banner_transitions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Transition'),
        ];
    }
}
