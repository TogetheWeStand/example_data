<?php

use yii\db\Migration;

/**
 * Class M180731083023PushToken
 */
class M180731083023PushToken extends Migration
{
    private $tableName = 'my.push_token';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey()->comment('Индекс'),
                'token' =>
                    $this->string(255)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Токен устройства'),
            ]
        );

        $this->addCommentOnTable(
            $this->tableName,
            "Токены устройств пользователей для отправки push уведомлений"
        );
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
