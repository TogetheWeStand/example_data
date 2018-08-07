<?php

use yii\db\Migration;

/**
 * Class M180731083802PushUserToken
 */
class M180731083802PushUserToken extends Migration
{
    private $schema = 'my';
    private $tableName = 'push_user_token';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = $this->schema . '.' . $this->tableName;

        $this->createTable(
            $tableName,
            [
                'id' => $this->primaryKey()->comment('Индекс'),
                'user_id' => $this->integer(11)->notNull()->comment('Идентификатор пользователя'),
                'token_id' => $this->integer(11)->notNull()->comment('Идентификатор токена')
            ]
        );

        $this->addCommentOnTable(
            $tableName,
            "Связь пользователей с токенами устройств"
        );

        $this->addForeignKey(
            'fk-push-user_id',
            $tableName,
            'user_id',
            $this->schema . '.' . 'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-push-token_id',
            $tableName,
            'token_id',
            $this->schema . '.' . 'push_token',
            'id',
            'CASCADE'
        );
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $tableName = $this->schema . '.' . $this->tableName;

        $this->dropForeignKey(
            'fk-push-user_id',
            $tableName
        );

        $this->dropForeignKey(
            'fk-push-token_id',
            $tableName
        );

        $this->dropTable($tableName);
    }
}
