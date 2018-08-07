<?php

use yii\db\Migration;
use \yii\db\Expression;

/**
 * Class M180621085602UserBarcodeStructure
 */
class M180621085602UserBarcodeStructure extends Migration
{
    private $tableName = 'my1.user_barcode';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey()->comment('Индекс'),
                'barcode' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Штрихкод')
                        ->unique(),
                'article' => $this->string(30)->notNull()->comment('Артикул'),
                'user_id' => $this->integer(11)->notNull()->comment('Пользователь'),
                'date_create' =>
                    $this->dateTime()
                        ->notNull()
                        ->defaultValue(new Expression('NOW()'))
                        ->comment('Дата создания'),
                'type' => $this->string(1)->notNull()->comment('Тип изделия'),
                'type_metall' => $this->string(50)->defaultValue(null)->comment('Тип металла'),
                'sales_department' =>
                    $this->string(1)->defaultValue(null)->comment('Отдел продаж'),
                'manual_registration' =>
                    $this->boolean()->notNull()->defaultValue(false)->comment('Тип регистрации'),
            ]
        );

        $this->addCommentOnTable($this->tableName, "Зарегистрированные штрихкоды");
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
