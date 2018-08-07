<?php

namespace app\modules\notice\controllers;

use Yii;
use yii\web\Controller;
use app\modules\notice\models\Mail;
use app\modules\notice\models\Push;

/**
 * Class NoticeController
 * @package app\modules\notice\controllers
 */
class NoticeController extends Controller
{
    /**
     * Sent notification by email.
     * @return bool
     */
    public function actionMail() : bool
    {
        $sent = new Mail();

        return $sent->mail(
            'esizov.realize@yandex.ru',
            'Stargorin@rambler.ru',
            'Money',
            "<h3><text>Bla-bla</text></h3><b><p><a href=\"http://barsuck.com\">Barsuck</a></p></b>"
        );
    }

    /**
     * Sent push notification.
     * @return bool
     */
    public function actionPush() : bool
    {
        $sent = new Push();
        return $sent->push();
    }

    /**
     * Get user subscription for push notifications.
     *
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUserSubscription() : bool
    {
        $curentToken = Yii::$app->request->post('curentToken');
        $newToken = Yii::$app->request->post('newToken');
        $saved = true;
        $linked = true;

        $model = new Push();

        if (strcmp($curentToken, $newToken)) {
            $saved = $model->saveToken($newToken);

            if (!$saved) {
                return false;
            }

            if ($curentToken !== null) {
                $model->replaceCurentToken($curentToken, $newToken);
                $model->removeToken($curentToken);
            }
        }

        if (!$model->userAlreadyLinked(Yii::$app->user->id, $newToken)) {
            $linked = $model->linkTokenToUser($newToken);
        }

        $marked = $model->markUserAsSubscribed(Yii::$app->user->id);

        return $saved && $linked && $marked;
    }
}
