<?php

namespace app\models;

/**
 * Class Messages
 * @package app\models
 */
class Messages
{
    /**
     * @param string $id
     * @return mixed
     */
    public static function get(string $id)
    {
        return self::getList()[$id];
    }

    /**
     * @return mixed
     */
    private static function getList()
    {
        $messages['incorrect_barcode'] = 'Не верный штрихкод.';
        $messages['no_article_data'] = 'Не удалось получить подробные данные об изделии.';
        $messages['already_exists_barcode'] = 'Данный штрихкод уже зарегистрирован.';
        $messages['registry'] = 'Зарегистрировать';
        $messages['check'] = 'Проверить';
        $messages['product_authentication_failed'] = 'Введённые данные не обнаружены в автоматизированной системе 
            SOKOLOV. Пожалуйста, проверьте правильность заполнения полей';
        $messages['product_authentication_success'] = 'Поздравляем! Вы обладаете подлинным изделием бренда SOKOLOV.';
        $messages['complaint'] = 'Отправить жалобу';
        $messages['report_failed'] = 'Ошибка при отправке, пожалуйста попробуйте позже.';
        $messages['report_success'] = 'Жалоба успешно отправлена.';
        $messages['password_fogot'] = 'Забыли пароль?';
        $messages['sent'] = 'Отправить';
        $messages['sent_link_responce'] = 'На Ваш почтовый ящик отправллена ссылка, 
            перейдя по которой, вы сможете изменить пароль. Срок действия ссылки истекает через один час.';
        $messages['change_password'] = 'Сменить пароль';
        $messages['password_change_succes'] = 'Пароль успешно изменён';
        $messages['password_change_failed'] = 'Ссылка устарела или заданы не верные параметры';
        $messages['password_restore_msg'] = 'Это сообщение было отправлено Вам в ответна ваш запрос восстановления 
            пароля. Для продолжения процедуры перейдите по ссылке ниже. Ссылка активна в течении одного часа. 
            Если вы не запрашивали восстановление пароля, оставьте это письмо без внимания.';
        $messages['registration_confirmation'] = 'Это сообщение было отправлено Вам с целью подтверждения регистрации 
            на сайте my.sokolov.ru. Для продолжения процедуры перейдите по ссылке ниже. Если вы не регистрировались на 
            сайте, оставьте это письмо без внимания.';
        $messages['registration_confirmation_success'] = 'Благодарим за подтверждение регистрации, 
            теперь Вам доступна вся функциональность сайта!';
        $messages['registration_confirmation_failed'] = 'Не удалось подтвердить регистрацию';
        $messages['registration_success'] = 'Вы успешно зарегистрировались. На указанный при регистрации почтовый ящик 
            отправлено сообщение со ссылкой для подтверждения регистрации. Перейдите по ссылке чтобы завершить 
            регистрацию и получить доступ ко всем функциям сайта.';

        return $messages;
    }
}
