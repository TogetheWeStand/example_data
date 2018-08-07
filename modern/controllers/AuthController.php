<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\auth\LoginForm;
use app\models\auth\RegistrationForm;
use app\models\Messages;
use app\models\auth\ChangePasswordForm;
use app\models\auth\SentRestoreLinkForm;

/**
 * Class AuthController
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() : array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }

    /**
     * Logout action.
     * @return Response
     */
    public function actionLogout() : Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @return string|Response
     * @throws \Exception
     */
    public function actionRegistration()
    {
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $msg = $model->saveNewUser();
            return $this->render('password-confirmation', ['msg' => $msg]);
        } else {
            return $this->render('registration', ['model' => $model]);
        }

    }

    /**
     * @return string
     */
    public function actionRestorePassword() : string
    {
        $model = new SentRestoreLinkForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->sentRestoreLink();

            return $this->render(
                'restore-password',
                ['model' => $model, 'msg' => Messages::get('sent_link_responce')]
            );
        } else {
            return $this->render('restore-password', ['model' => $model]);
        }
    }

    /**
     * @return string
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionChangePassword() : string
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $login = Yii::$app->session['login'];

            $model->saveNewPassword($login);

            return $this->render(
                'change-password',
                ['model' => $model, 'msg' => Messages::get('password_change_succes')]
            );
        } else {
            $login = Yii::$app->request->get('login');

            if ($model->checkPasswordChangeRequest($login, Yii::$app->request->get('hash'))) {

                if (!Yii::$app->session->getIsActive()) {
                    Yii::$app->session->open();
                }

                Yii::$app->session['login'] = $login;
                Yii::$app->session->close();

                return $this->render('change-password', ['model' => $model]);
            } else {
                return $this->render(
                    'change-password',
                    ['model' => $model, 'msg' => Messages::get('password_change_failed')]
                );
            }
        }
    }

    /**
     * @return string
     */
    public function actionPasswordConfirmation() : string
    {
        $login = Yii::$app->request->get('login');
        $hash = Yii::$app->request->get('hash');

        $model = new RegistrationForm();
        $msg = $model->confirmRegistration($login, $hash);

        return $this->render('password-confirmation', ['msg' => $msg]);
    }
}
