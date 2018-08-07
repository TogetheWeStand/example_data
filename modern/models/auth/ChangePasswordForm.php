<?php
namespace app\models\auth;

use yii\base\Model;
use app\models\User;
use app\models\db\RestorePasswordList;

/**
 * Class RestoreForm
 * @package app\models\auth
 */
class ChangePasswordForm extends Model
{
    public $password;
    public $password_confirm;

    /**
     * @return array the validation rules.
     */
    public function rules() : array
    {
        return [
            [['password', 'password_confirm'], 'required'],
            ['password_confirm', 'passwordComparison'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() : array
    {
        return [
            'password' => 'Новый пароль',
            'password_confirm' => 'Подтверждение пароля'
        ];
    }

    /**
     * @param string $attribute
     */
    public function passwordComparison(string $attribute)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->password_confirm) {
                $this->addError($attribute, 'Пароли не совпадают.');
            }
        }
    }

    /**
     * @param string $login
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function saveNewPassword(string $login)
    {
        $user = User::find()->where(['login' => $login])->one();
        $user->password = User::generatePasswordHash(['password' => $this->password]);
        $user->update();
    }

    /**
     * @param string $login
     * @param string $hash
     * @return bool
     */
    public function checkPasswordChangeRequest(string $login, string $hash) : bool
    {
        $result = false;
        $model = RestorePasswordList::find()->where(['login' => $login, 'hash' => $hash])->one();

        if ($model !== null && $model->date_expired >= time()) {
            $result = true;
        }

        return $result;
    }
}
