<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "poll".
 *
 * @property int $id
 * @property int $active Активность
 * @property int $completed Завершен
 * @property string $date_create Дата создания
 * @property string $date_update Дата обновления
 * @property string $start_date Дата начала
 * @property string $end_date Дата завершения
 * @property string $title Название опроса
 * @property string $code Символьный код
 * @property int $sort Сортировка
 * @property int $created_by Кем создано
 * @property int $modify_by Кем изменено
 * @property string $webanketa_key Ключ анкеты
 * @property int $cost Стоимость
 */
class Poll extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'my.poll';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'completed', 'sort', 'created_by', 'modify_by', 'cost'], 'default', 'value' => null],
            [['active', 'completed', 'sort', 'created_by', 'modify_by', 'cost'], 'integer'],
            [['date_create', 'date_update', 'start_date', 'end_date'], 'safe'],
            [['title', 'code', 'webanketa_key'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Active',
            'completed' => 'Completed',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'title' => 'Title',
            'code' => 'Code',
            'sort' => 'Sort',
            'created_by' => 'Created By',
            'modify_by' => 'Modify By',
            'webanketa_key' => 'Webanketa Key',
            'cost' => 'Cost',
        ];
    }
}
