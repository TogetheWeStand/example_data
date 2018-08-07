<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * Class ProductAuthComplaint
 * @property $id
 * @property $user_id
 * @property $fio
 * @property $email_phone
 * @property $shop_name
 * @property $shop_address
 * @property $product_photo_id
 * @property $cheque_photo_id
 * @package app\models\service
 */
class ProductAuthComplaint extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return "my.product_genuine_complaint";
    }
}
