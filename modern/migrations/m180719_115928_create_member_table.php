<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 */
class m180719_115928_create_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('my.member', [
            'id' => $this->primaryKey(),
            'activity_id' => $this->integer(11)->comment('ID акции'),
            'poll_id' => $this->integer(11)->comment('ID опроса'),
            'date_create' => $this->dateTime()->comment('Дата создания'),
            'user_id' =>$this->integer(11)->comment('ID пользователя'),
            'number' => $this->string(100)->comment('Номер участника'),
            'win' => $this->tinyInteger(1)->comment('Победитель')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('my.member');
    }
}
