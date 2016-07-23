<?php

namespace c006\widget\banner\models;

use Yii;

/**
 * This is the model class for table "widget_banner_files".
 *
 * @property integer $id
 * @property string $name
 * @property string $file
 * @property integer $width
 * @property integer $height
 */
class WidgetBannerFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget_banner_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['width', 'height'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['file'], 'image'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'     => Yii::t('app', 'ID'),
            'name'   => Yii::t('app', 'Name'),
            'file'   => Yii::t('app', 'File'),
            'width'  => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
        ];
    }
}
