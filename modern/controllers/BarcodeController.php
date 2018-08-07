<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\my\barcode\Barcode;

/**
 * Class BarcodeController
 * @package app\controllers
 */
class BarcodeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'actions' => ['registration'],
                    'allow' => true,
                ],
            ],
        ];

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionRegistration()
    {
        $model = new Barcode();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = $model->getRegistrationData();

            if (empty($data['error'])) {
                $model->registerBarcode($data);
            } else {
                $data = $data['error'];
            }

            return $this->render('//my/barcode/registration', ['data' => $data]);
        } else {
            return $this->render('//my/barcode/registration', ['model' => $model]);
        }
    }
}
