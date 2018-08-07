<?php

namespace app\controllers\service;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\service\ProductAuthentication;
use app\models\DataRepository;
use app\models\Messages;
use app\models\service\Report;
use app\models\UploadedFileCustom;

/**
 * Class ProductAuthenticationController
 * @package app\controllers\service
 */
class ProductAuthenticationController extends Controller
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
                    'actions' => ['index', 'report'],
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
    public function actionIndex()
    {
        $model = new ProductAuthentication();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $barcode = htmlspecialchars(Yii::$app->request->post('ProductAuthentication')['barcode']);
            $article = htmlspecialchars(Yii::$app->request->post('ProductAuthentication')['article']);

            $model = new DataRepository();

            $result = $model->findBarcode($barcode);

            if (empty($result['error']) && $result['ARTICLE'] === $article) {
                $data = $model->findArticle($article);
                $data['msg'] = Messages::get('product_authentication_success');

                return $this->render('success', ['data' => $data]);
            } else {
                if (!Yii::$app->session->getIsActive()) {
                    Yii::$app->session->open();
                }

                Yii::$app->session['report'] = ['barcode' => $barcode, 'article' => $article];
                Yii::$app->session->close();

                return $this->redirect('report');
            }
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }

    /**
     * @return string
     */
    public function actionReport()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post())) {
            $model->product_photo = UploadedFileCustom::getInstance($model, 'product_photo');
            $model->cheque_photo = UploadedFileCustom::getInstance($model, 'cheque_photo');

            $result = $model->uploadImages();

            if (!$result['error']) {
                $model->saveComplaint($result);
            }

            return $this->render('report', ['msg' => $result['msg']]);
        } else {
            $data = Yii::$app->session['report'];

            return $this->render('error', [
                    'msg' => Messages::get('product_authentication_failed'),
                    'data' => $data,
                    'model' => $model
                ]);
        }
    }
}
