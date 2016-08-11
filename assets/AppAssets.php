<?php

namespace c006\widget\banner\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAssets extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/c006/yii2-widget-banner/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        'web/css/widget-banner.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/widget-banner.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [];

    /**
     * @var array
     */
    public $jsOptions = [
        'position' => View::POS_END,
    ];

}
