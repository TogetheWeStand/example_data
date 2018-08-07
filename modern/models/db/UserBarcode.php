<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * Class UserBarcode
 * @property $id
 * @property $barcode
 * @property $article
 * @property $user_id
 * @property $type
 * @property $type_metall
 * @property $sales_department
 * @property $manual_registration
 * @package app\models\my\barcode
 */
class UserBarcode extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return "my.user_barcode";
    }
}
