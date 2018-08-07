<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * Class RestorePasswordList
 * @property $id
 * @property $login
 * @property $hash
 * @property $date_expired
 * @package app\models\db
 */
class RestorePasswordList extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName() : string
    {
        return "my.restore_password_list";
    }
}
