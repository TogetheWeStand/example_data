<?php

namespace app\models;

use yii\web\UploadedFile;

/**
 * Class UploadedFileCustom
 * @package app\models
 */
class UploadedFileCustom extends UploadedFile
{
    public $encrypted_name;
    private $image_path = '';

    /**
     * UploadedFileCustom constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        $this->encrypted_name = md5($this->baseName . time()) . '.' . $this->extension;
    }

    /**
     * @return string
     */
    public function getImagePath() : string
    {
        return $this->image_path;
    }

    /**
     * @param string $path
     */
    public function setImagePath($path)
    {
        $this->image_path = $path;
    }

    /**
     * @return array
     */
    public function getImageResolution() : array
    {
        $imgData = getimagesize($this->image_path . $this->encrypted_name);
        return ['width' => $imgData[0], 'height' => $imgData[1]];
    }
}