<?php

namespace app\modules\notice\models;

use Yii;
use yii\base\Model;

/**
 * Class Mail
 * @package app\modules\notice\models
 */
class Mail extends Model
{
    /**
     * @param string $from
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public function mail(string $from, string $to, string $subject, string $body) : bool
    {
        return Yii::$app->mailer->compose()
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setHtmlBody($body)
            ->send();
    }
}
