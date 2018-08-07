<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * Class File
 * @property $id
 * @property $file_name
 * @property $original_name
 * @property $subdir
 * @property $content_type
 * @property $file_size
 * @property $height
 * @property $width
 * @package app\models
 */
class File extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return "my.file";
    }
}
