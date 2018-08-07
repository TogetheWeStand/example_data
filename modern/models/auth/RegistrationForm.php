<?php
namespace app\models\auth;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Messages;

/**
 * Class RegistrationForm
 * @package app\models\auth
 */
class RegistrationForm extends Model
{
    public $login;
    public $password;
    public $password_confirm;

    /**
     * @return array the validation rules.
     */
    public function rules() : array
    {
        return [
            [['login', 'password', 'password_confirm'], 'required'],
            ['login', 'email'],
            ['login', 'validateAttribute'],
            ['password_confirm', 'passwordComparison'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() : array
    {
        return [
            'login' => 'Email',
            'password' => 'Пароль',
            'password_confirm' => 'Подтверждение пароля',
        ];
    }

    /**
     * @param string $attribute
     */
    public function validateAttribute(string $attribute)
    {
        if (!$this->hasErrors()) {
            $alreadyExists = User::find()->where([$attribute => $this->$attribute])->one();

            if ($alreadyExists !== null) {
                $this->addError($attribute, 'Уже зарегистрирован.');
            }
        }
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
     * @return mixed
     * @throws \Exception
     */
    public function saveNewUser() : string
    {
        $newUser = new User();
        $newUser->login = $this->login;
        $newUser->password = User::generatePasswordHash(['password' => $this->password]);
        $newUser->active = User::STATUS_ACTIVE;
        $newUser->email = $this->login;

        $date = new \DateTime('now', new \DateTimeZone("UTC"));
        $newUser->date_register = $date->format('Y-m-d H:i:s');

        $hash = $this->sentConfirmationLink();

        $newUser->confirmation_hash = $hash;

        $newUser->save();

        return Messages::get("registration_success");
    }

    /**
     * Sent restore password message with link for restore.
     * @return string
     */
    public function sentConfirmationLink()
    {
        $hash = md5($this->login . time());
        $link = $this->createConfirmationLink($hash);

        Yii::$app->mailer->compose()
            ->setFrom('sokolov@confirmation.net')
            ->setTo($this->login)
            ->setSubject('Подтверждение регистрации')
            ->setHtmlBody("<h3><text>" . Messages::get("registration_confirmation") .
                "</text></h3><b><p><a href=\"$link\">$link</a></p></b>")
            ->send();

        return $hash;
    }

    /**
     * @param string $hash
     * @return string
     */
    private function createConfirmationLink(string $hash) : string
    {
        $base_url = preg_replace(
            "/registration/",
            "password-confirmation",
            Yii::$app->request->referrer
        );

        return $base_url . "?login=$this->login&hash=" . $hash;
    }

    /**
     * @param string $login
     * @param string $hash
     * @return mixed
     */
    public function confirmRegistration(string $login, string $hash) : string
    {
        $msg = Messages::get("registration_confirmation_failed");
        $model = User::find()->where(["login" => $login, "confirmation_hash" => $hash])->one();

        if ($model !== null) {
            $model->confirmed = "Y";
            $model->save();
            $msg = Messages::get("registration_confirmation_success");
        }

        return $msg;
    }
}
