<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property int $activity_id ID акции
 * @property int $poll_id ID опроса
 * @property string $date_create Дата создания
 * @property int $user_id ID пользователя
 * @property string $number Номер участника
 * @property int $win Победитель
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'my.member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'poll_id', 'user_id', 'win'], 'default', 'value' => null],
            [['activity_id', 'poll_id', 'user_id', 'win'], 'integer'],
            [['date_create', 'number'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity ID',
            'poll_id' => 'Poll ID',
            'date_create' => 'Date Create',
            'user_id' => 'User ID',
            'number' => 'Number',
            'win' => 'Win',
        ];
    }
}
