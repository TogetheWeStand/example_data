<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Class M180724115106UserStructure
 */
class M180724115106UserStructure extends Migration
{
    private $tableName = 'my.user';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            $this->tableName,
            [
                'id' => $this->primaryKey()->comment('Индекс'),
                'timestamp_x' =>
                    $this->dateTime()
                        ->notNull()
                        ->defaultValue(new Expression('NOW()'))
                        ->comment('Непонятная фигня'),
                'login' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Логин'),
                'email' =>
                    $this->string(255)
                        ->defaultValue('')
                        ->comment('Электронная почта'),
                'password' =>
                    $this->string(50)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Пароль'),
                'checkword' =>
                    $this->string(50)
                        ->defaultValue('')
                        ->comment('Неизвестная фигня'),
                'active' =>
                    $this->string(1)
                        ->notNull()
                        ->defaultValue('Y')
                        ->comment('Активность учётной записи'),
                'gender' =>
                    $this->string(1)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Пол'),
                'birthday' =>
                    $this->date()
                        ->defaultValue(null)
                        ->comment('Дата рождения'),
                'name' =>
                    $this->string(50)
                        ->defaultValue('')
                        ->comment('Имя'),
                'surname' =>
                    $this->string(50)
                        ->defaultValue('')
                        ->comment('Фамилия'),
                'patronymic' =>
                    $this->string(50)
                        ->defaultValue('')
                        ->comment('Отчество'),
                'login_attempts' =>
                    $this->integer(5)
                        ->defaultValue(0)
                        ->comment('Попытки авторизации'),
                'last_login' => $this->dateTime()->comment('Дата последней авторизации'),
                'last_activity_date' => $this->dateTime()->comment('Неизвестная фигня'),
                'date_register' =>
                    $this->dateTime()
                        ->notNull()
                        ->defaultValue(new Expression('NOW()'))
                        ->comment('Дата регистрации'),
                'checkword_time' => $this->dateTime()->comment('Неизвестная фигня'),
                'language_id' =>
                    $this->string(2)
                        ->defaultValue('')
                        ->comment('Неизвестная фигня'),
                'lid' =>
                    $this->string(2)
                        ->defaultValue('')
                        ->comment('Неизвестная фигня'),
                'external_auth_id' => $this->string(255)->comment(''),
                'confirmed' =>
                    $this->string(1)
                        ->notNull()
                        ->defaultValue('N')
                        ->comment('Статус подтверждения регистрации'),
                'confirmation_hash' =>
                    $this->string(255)
                        ->notNull()
                        ->defaultValue('')
                        ->comment('Хеш для подтверждения регистрации'),
                'confirm_code' => $this->string(8)->comment('Неизвестная фигня'),
                'stored_hash' => $this->string(32)->comment('stored hash'),
                'time_zone' => $this->string(50)->comment('Часовой пояс'),
                'time_zone_offset' => $this->integer(18)->comment('Неизвестная фигня'),
                'title' => $this->string(32)->comment('Неизвестная фигня'),
                'auto_time_zone' => $this->string(1)->comment('Неизвестная фигня'),
                'admin_notes' => $this->text()->comment('Неизвестная фигня'),
                'personal_phone' => $this->string(255)->defaultValue('')->comment('Телефон'),
                'personal_birthdate' => $this->string(50)->defaultValue('')->comment(''),
                'personal_city' => $this->string(255)->comment('Город пользователя'),
                'personal_country' => $this->string(255)->comment('Страна пользователя'),
                'personal_fax' => $this->string(255)->comment('Факс пользователя'),
                'personal_icq' => $this->string(255)->comment('ICQ пользователя'),
                'personal_mailbox' => $this->string(255)->comment('mailbox пользователя'),
                'personal_mobile' => $this->string(255)->comment('mobile пользователя'),
                'personal_notes' => $this->text()->comment('notes пользователя'),
                'personal_pager' => $this->string(255)->comment('pager пользователя'),
                'personal_photo' => $this->integer(18)->comment('photo пользователя'),
                'personal_profession' => $this->string(255)->comment('Профессия пользователя'),
                'personal_state' => $this->string(255)->comment('state пользователя'),
                'personal_street' => $this->text()->comment('street пользователя'),
                'personal_www' => $this->string(255)->comment('www пользователя'),
                'personal_zip' => $this->string(255)->comment('zip пользователя'),
                'work_city' => $this->string(255)->comment('Город рабочий'),
                'work_company' => $this->string(255)->comment('work_company'),
                'work_country' => $this->string(255)->comment('work_country'),
                'work_department' => $this->string(255)->comment('Неизвестная фигня'),
                'work_fax' => $this->string(255)->comment('work_fax'),
                'work_logo' => $this->integer(18)->comment('work_logo'),
                'work_mailbox' => $this->string(255)->comment('work_mailbox'),
                'work_notes' => $this->text()->comment('work_notes'),
                'work_pager' => $this->string(255)->comment(''),
                'work_phone' => $this->string(255)->comment(''),
                'work_position' => $this->string(255)->comment(''),
                'work_profile' => $this->text()->comment(''),
                'work_state' => $this->string(255)->comment(''),
                'work_street' => $this->text()->comment(''),
                'work_www' => $this->string(255)->comment(''),
                'work_zip' => $this->string(255)->comment(''),
                'xml_id' => $this->string(255)->comment(''),
                'push_subscription' =>
                    $this->boolean()
                        ->notNull()
                        ->defaultValue(false)
                        ->comment('Подписка на пуш уведомления'),
            ]
        );

        $this->addCommentOnTable($this->tableName, "Зарегистрированные пользователи");
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
