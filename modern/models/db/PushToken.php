<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * Class PushToken
 *
 * @property integer $id
 * @property string $token
 *
 * @package app\models\db
 */
class PushToken extends ActiveRecord
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToken()
    {
        return $this->hasMany(PushUserToken::className(),['token_id' => 'id']);
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return "my.push_token";
    }
}
