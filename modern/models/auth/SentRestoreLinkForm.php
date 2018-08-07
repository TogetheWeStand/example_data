<?php
namespace app\models\auth;

use Yii;
use yii\base\Model;
use app\models\db\RestorePasswordList;
use app\models\Messages;
use app\models\User;

/**
 * Class RestoreForm
 * @package app\models\auth
 */
class SentRestoreLinkForm extends Model
{
    public $login;

    /**
     * @return array the validation rules.
     */
    public function rules() : array
    {
        return [
            [['login'], 'required'],
            ['login', 'email'],
            ['login', 'validateAttribute']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() : array
    {
        return [
            'login' => 'Email'
        ];
    }

    /**
     * @param string $attribute
     */
    public function validateAttribute(string $attribute)
    {
        if (!$this->hasErrors()) {
            $alreadyExists = User::find()->where([$attribute => $this->$attribute])->one();

            if ($alreadyExists === null) {
                $this->addError($attribute, 'Данный пользователь не зарегистрирован.');
            }
        }
    }

    /**
     * Sent restore password message with link for restore.
     */
    public function sentRestoreLink()
    {
        $link = $this->createRestoreLink();

        Yii::$app->mailer->compose()
            ->setFrom('sokolov@restore.net')
            ->setTo($this->login)
            ->setSubject('Восстановление пароля')
            ->setHtmlBody("<h3><text>" . Messages::get("password_restore_msg") .
                "</text></h3><b><p><a href=\"$link\">$link</a></p></b>")
            ->send();
    }

    /**
     * @return string
     */
    private function createRestoreLink() : string
    {
        $hash = md5($this->login . time());

        $base_url = preg_replace(
            "/restore-password/",
            "change-password",
            Yii::$app->request->referrer
        );

        $this->saveRestorePasswordRecord($this->login, $hash);

        return $base_url . "?login=$this->login&hash=" . $hash;
    }

    /**
     * @param string $login
     * @param string $hash
     */
    private function saveRestorePasswordRecord(string $login, string $hash)
    {
        $one_hour = 3600;

        $model = new RestorePasswordList();
        $model->login = $login;
        $model->hash = $hash;
        $model->date_expired = time() + $one_hour;

        $model->save();
    }
}
