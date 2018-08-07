<?php

use yii\db\Migration;
use \yii\db\Expression;

/**
 * Class M180629130316FileStructure
 */
class M180629130316FileStructure extends Migration
{
    private $tableName = 'my1.file';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey()->comment('Индекс'),
                'file_name' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Кодированное имя файла'),
                'original_name' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Оригинальное имя файла'),
                'subdir' =>
                    $this->string(255)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Путь до файла'),
                'content_type' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Тип содержимого'),
                'file_size' => $this->integer(11)->notNull()->comment('Размер файла'),
                'height' => $this->integer(6)->notNull()->comment('Высота изображения'),
                'width' => $this->integer(6)->notNull()->comment('Ширина изображения'),
                'date_create' =>
                    $this->dateTime()
                        ->notNull()
                        ->defaultValue(new Expression('NOW()'))
                        ->comment('Дата создания')
            ]
        );

        $this->addCommentOnTable($this->tableName, "Зарегистрированные штрихкоды");
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
