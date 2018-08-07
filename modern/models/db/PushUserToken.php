<?php

namespace app\models\db;

use app\models\User;
use yii\db\ActiveRecord;

/**
 * Class PushUserToken
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $token_id
 *
 * @package app\models\db
 */
class PushUserToken extends ActiveRecord
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToken()
    {
        return $this->hasOne(PushToken::className(),['id' => 'token_id']);
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return "my.push_user_token";
    }
}
