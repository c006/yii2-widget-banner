<?php

namespace c006\widget\banner\assets;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class ImageHelper
{
    public $base_path = '';
    private $imagine;
    private $image = [];
    private $sizes = [
        'sml' => 400,
        'med' => 800,
        'lrg' => 1000,
    ];

    function __construct($base_path = FALSE)
    {
        $this->base_path = ($base_path) ? $base_path : \Yii::getAlias('@frontend') . '/web/images/widget/banner';
        $this->imagine = new Imagine();
    }


    public function saveImage($file, $tmp_file)
    {
        $this->image = [
            'image' => $tmp_file,
            'size'  => getimagesize($tmp_file)
        ];

        $size = self::getNewImageSize('lrg');
        $image = $this->imagine->open($this->image['image']);
        $image->resize(new Box($size['w'], $size['h']));
        $image->save($this->base_path . '/' . $file, ['quality' => 90]);
    }

    /**
     * @param $size
     * @param bool|TRUE $keep_ratio
     *
     * @return array
     */
    private function getNewImageSize($size, $keep_ratio = TRUE)
    {

        $nw = $nh = $this->sizes[ $size ];

        if ($keep_ratio) {
            /* W > H */
            if ($this->image['size'][0] > $this->image['size'][1]) {
                $ratio = $this->image['size'][1] / $this->image['size'][0];
                $nh = $nw * $ratio;
            } else {
                /* H > W */
                $ratio = $this->image['size'][0] / $this->image['size'][1];
                $nh = $nh * $ratio;
            }
        }

        return ['w' => $nw, 'h' => $nh];
    }

    /**
     * @param $file
     *
     * @return bool
     */
    public function deleteFile($file)
    {
        return @unlink($this->base_path . '/' . $file);
    }


    /**
     * @param $file
     *
     * @return mixed
     */
    static public function getFileExtension($file)
    {
        $file = explode('.', $file);

        return $file[ sizeof($file) - 1 ];

    }


}