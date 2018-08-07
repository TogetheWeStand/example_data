<?php

namespace app\models;

use yii\base\Model;
use app\models\db\File;

/**
 * Class Base
 * @package app\models
 */
class Base extends Model
{
    /**
     * @param array $data
     * @return mixed
     */
    public static function saveFile(array $data)
    {
        $model = new File();

        $model->file_name = $data['file_name'];
        $model->original_name = $data['original_name'];
        $model->subdir = $data['subdir'];
        $model->content_type = $data['content_type'];
        $model->file_size = $data['file_size'];
        $model->height = $data['height'];
        $model->width = $data['width'];

        $model->save();

        return $model->id;
    }
}
