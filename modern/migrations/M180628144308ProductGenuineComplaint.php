<?php

use yii\db\Migration;
use \yii\db\Expression;

/**
 * Class M180628144308ProductGenuineComplaint
 */
class M180628144308ProductGenuineComplaint extends Migration
{
    private $tableName = 'my1.product_genuine_complaint';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey()->comment('Индекс'),
                'user_id' => $this->integer(11)->comment('Идентификатор пользователя'),
                'fio' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Ф.И.О. пользователя'),
                'email_phone' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Email или номер телефона'),
                'shop_name' =>
                    $this->string(100)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Название магазина'),
                'shop_address' =>
                    $this->string(100)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Адрес магазина'),
                'product_photo_id' => $this->integer(11)->notNull()->comment('id фотографии продукта'),
                'cheque_photo_id' => $this->integer(11)->notNull()->comment('id фотографии чека'),
                'date_create' =>
                    $this->dateTime()
                        ->notNull()
                        ->defaultValue(new Expression('NOW()'))
                        ->comment('Дата создания')
            ]
        );

        $this->addCommentOnTable($this->tableName, "Жалобы покупателей на не подлинные изделия");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
