<?php

use yii\db\Migration;

/**
 * Handles the creation of table `code`.
 */
class m180725_132622_create_code_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $command = Yii::$app->db->createCommand("CREATE TYPE my.enum_code_type AS ENUM ('gift', 'scratch');");
        $command->execute();

        $this->createTable('my.code', [
            'id' => $this->primaryKey(),
            'type' => $this->getDb()->getSchema()->createColumnSchemaBuilder("my.enum_code_type default 'gift'")->comment('Тип кода'),
            'code' => $this->string(100)->comment('Код'),
            'partner_code' => $this->string(100)->comment('Код партнера'),
            'active' => $this->tinyInteger(1)->comment('Активность'),
            'activity_id' => $this->integer(11)->comment('ID активности'),
            'user_id' => $this->integer(11)->comment('ID пользователя'),
            'date_active_to' => $this->dateTime()->comment('Дата завершения активности'),
            'date_activate' => $this->dateTime()->comment('Дата активации кода'),
            'created_by' => $this->integer(11)->comment('Кем создано'),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('my.code');
    }
}
