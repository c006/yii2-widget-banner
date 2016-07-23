<?php

namespace c006\widget\banner;

use c006\widget\banner\assets\AppAssets;
use Yii;
use yii\bootstrap\Widget;

class WidgetBanner extends Widget
{

    private $id = '';

    private $class = 'WidgetBanner';

    public $banner_id = 0;


    function init()
    {
        parent::init();
        $view = $this->getView();
        AppAssets::register($view);

        $this->id = preg_replace('/[\s|\.]+/', '-', microtime(FALSE));

    }


    function run()
    {
        $array = [];
        if ($this->banner_id) {

            $array['banner'] = self::getBannerModel($this->banner_id);
            $array['banner']['transition'] = self::getBannerTransitionModel($array['banner']['transition_id']);
            $array['banner']['type'] = self::getBannerTransitionTyepModel($array['banner']['transition_type_id']);
            $array['items'] = self::getBannerItemsModel($this->banner_id);

//            print_r($array);
//            exit;

            return $this->render('index',
                [
                    'id'    => $this->id,
                    'class' => $this->class,
                    'array' => $array,
                ]);
        }
    }


    /**
     * @param $banner_id
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    private function getBannerModel($banner_id)
    {
        return \c006\widget\banner\models\WidgetBanner::find()
            ->where(['id' => $banner_id])
            ->asArray()
            ->one();
    }

    /**
     * @param $banner_id
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    private function getBannerItemsModel($banner_id)
    {
        $array = \c006\widget\banner\models\WidgetBannerItems::find()
            ->where(['banner_id' => $banner_id])
            ->andWhere(['<=', 'date_start', time()])
            ->andWhere(['>', 'date_end', time()])
            ->asArray()
            ->all();

        foreach ($array as $index => $item) {
            $array[ $index ]['file'] = self::getBannerFileModel($item['file_id']);
        }

        return $array;
    }

    /**
     * @param $file_id
     *
     * @return mixed|string
     */
    private function getBannerFileModel($file_id)
    {
        $model = \c006\widget\banner\models\WidgetBannerFiles::find()
            ->where(['id' => $file_id])
            ->asArray()
            ->one();
        if (sizeof($model)) {

            return [
                'file'   => $model['file'],
                'width'  => $model['width'],
                'height' => $model['height']
            ];
        }

        return FALSE;
    }

    private function getBannerTransitionModel($transition_id)
    {
        $model = \c006\widget\banner\models\WidgetBannerTransitions::find()
            ->where(['id' => $transition_id])
            ->asArray()
            ->one();
        if (sizeof($model)) {
            return $model['name'];
        }

        return FALSE;
    }

    private function getBannerTransitionTyepModel($transition_type_id)
    {
        $model = \c006\widget\banner\models\WidgetBannerTransitionTypes::find()
            ->where(['id' => $transition_type_id])
            ->asArray()
            ->one();
        if (sizeof($model)) {
            return $model['name'];
        }

        return FALSE;
    }
}
