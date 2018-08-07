<?php

use yii\db\Migration;

/**
 * Handles the creation of table `polls`.
 */
class m180717_110213_create_polls_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('my.poll', [
            'id' => $this->primaryKey(),
            'active' => $this->tinyInteger(1)->comment('Активность'),
            'completed' => $this->tinyInteger(1)->comment('Завершен'),
            'date_create' => $this->dateTime()->comment('Дата создания'),
            'date_update' => $this->dateTime()->comment('Дата обновления'),
            'start_date' => $this->dateTime()->comment('Дата начала'),
            'end_date' => $this->dateTime()->comment('Дата завершения'),
            'title' => $this->string(100)->comment('Название опроса'),
            'code' => $this->string(100)->comment('Символьный код'),
            'sort' => $this->integer(11)->comment('Сортировка'),
            'created_by' => $this->integer(11)->comment('Кем создано'),
            'modify_by' =>  $this->integer(11)->comment('Кем изменено'),
            'webanketa_key' => $this->string(100)->comment('Ключ анкеты'),
            'cost' => $this->integer(11)->comment('Стоимость'),
            'users_viewed' => $this->integer(11)->comment('Кол-во пользователей, открывших опрос'),
            'users_finished' => $this->integer(11)->comment('Кол-во пользователей, прошедших опрос')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('my.poll');
    }
}
