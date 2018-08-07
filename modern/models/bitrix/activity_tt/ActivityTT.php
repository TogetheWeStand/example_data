<?php

namespace app\models\bitrix\user;

use Yii;
use \yii\db\ActiveRecord;
use \yii\db\ActiveQuery;

/**
 * This is the model class for table "my_activity_tt".
 *
 * @property integer $ID
 * @property string $ACTIVITY_ID
 * @property string $TT_ID
 * @property integer $GIFT_GIVING_CENTER
 *
 * @property ActiveQuery userFields
 */
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_activity_tt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'GIFT_GIVING_CENTER'
                ],
                'safe'
            ],
            [['ACTIVITY_ID', 'TT_ID'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ACTIVITY_ID' => 'ID активности',
            'TT_ID' => 'ID торговой точки',
            'GIFT_GIVING_CENTER' => 'Является центром выдачи призов',
        ];
    }

    public static function getDb()
    {
        return Yii::$app->db_mysql;
    }

}
