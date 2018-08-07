<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $subscribed = User::findOne(['id' => Yii::$app->user->id]);
        return $this->render('about', ['subscribed' => $subscribed->push_subscription]);
    }
}
