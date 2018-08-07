<?php

use yii\db\Migration;

/**
 * Class M180716112148RestorePasswordList
 */
class M180716112148RestorePasswordList extends Migration
{
    private $tableName = 'my.restore_password_list';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey()->comment('Индекс'),
                'login' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Логин'),
                'hash' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Хеш отправленный пользователю на Email'),
                'date_expired' =>
                    $this->integer(11)
                        ->notNull()
                        ->defaultValue(0)
                        ->comment('Дата окончания действия ссылки')
            ]
        );

        $this->addCommentOnTable($this->tableName, "Зарегистрированные запросы на смену пароля");
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

}
