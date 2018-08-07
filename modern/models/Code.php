<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "code".
 *
 * @property int    $id
 * @property string $type Тип кода
 * @property string $code Код
 * @property string $partner_code Код партнера
 * @property int    $active Активность
 * @property int    $activity_id ID активности
 * @property int    $user_id ID пользователя
 * @property string $date_active_to Дата завершения активности
 * @property string $date_activate Дата активации кода
 * @property int    $created_by Кем создано
 */
class Code extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'my.code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['active', 'activity_id', 'user_id', 'created_by'], 'default', 'value' => null],
            [['active', 'activity_id', 'user_id', 'created_by'], 'integer'],
            [['date_active_to', 'date_activate'], 'safe'],
            [['code', 'partner_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'code' => 'Code',
            'partner_code' => 'Partner Code',
            'active' => 'Active',
            'activity_id' => 'Activity ID',
            'user_id' => 'User ID',
            'date_active_to' => 'Date Active To',
            'date_activate' => 'Date Activate',
            'created_by' => 'Created By',
        ];
    }

    public function getRandGiftCode()
    {
        $rsCode = (new \yii\db\Query())
            ->select(['type', 'partner_code', 'code', 'id'])
            ->from('my.code')
            ->orderBy(['random()' => SORT_DESC])
            ->limit(1);
        foreach ($rsCode->each() as $code) {
            $arCode[] = $code;
        }

        return $arCode;

    }
}
