<?php

namespace app\modules\notice\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\db\PushToken;
use app\models\db\PushUserToken;

/**
 * Class Push
 * @package app\modules\notice\models
 */
class Push extends Model
{
    /**
     * Sent push message
     *
     * Alarm! Be advised that $registration_ids variable need content only unique tokens,
     * for escaping situations when we send same messages for several user on one device.
     *
     * @return bool
     */
    public function push() : bool
    {
        $file = json_decode(file_get_contents("../modules/notice/push_server_data.json"), true);

        $registration_ids = PushUserToken::find()->where(['user_id' => Yii::$app->user->id])->all();

        foreach($registration_ids as $key => $device) {
            $registration_ids[$key] = $registration_ids[$key]->token->token;
        }

        $request_body = [
            'notification' => [
                'title' => 'Trush push',
                'body' => sprintf('Начало в %s.', date('H:i')),
                'icon' => 'https://new.sokolov.local/upload/service/push/test_push.jpg?width=240&height=192',
                'click_action' => 'https://sokolov.ru/',
            ],
            "registration_ids" => $registration_ids
        ];

        $fields = json_encode($request_body);

        $request_headers = [
            'Content-Type: application/json',
            'Authorization: key=' . $file['api_key'],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file['url']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * @param string $token
     * @return bool
     */
    public function saveToken(string $token) : bool
    {
        $model = new PushToken();
        $model->token = $token;
        return $model->save();
    }

    /**
     * @param string $token
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function removeToken(string $token) : bool
    {
        $result = false;
        $model = PushToken::findOne(['token' => $token]);

        if ($model !== null) {
            $result = $model->delete();
        }

        return $result;
    }

    /**
     * @param string $curent
     * @param string $new
     * @return int
     */
    public function replaceCurentToken(string $curent, string $new)
    {
        $updatedRowsCount = PushUserToken::updateAll(
            ['token_id' => PushToken::findOne(['token' => $new])->id],
            ['=', 'token_id', PushToken::findOne(['token' => $curent])->id]
        );

        return $updatedRowsCount;
    }

    /**
     * @param string $token
     * @return bool
     */
    public function linkTokenToUser(string $token) : bool
    {
        $model = new PushUserToken();

        $model->user_id = Yii::$app->user->id;
        $model->token_id = PushToken::findOne(['token' => $token])->id;

        return $model->save();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function markUserAsSubscribed(int $id) : bool
    {
        $model = User::findOne(['id' => $id]);

        $model->push_subscription = true;

        return $model->save();
    }

    /**
     * @param int $id
     * @param string $token
     * @return bool
     */
    public function userAlreadyLinked(int $id, string $token) : bool
    {
        $result = PushUserToken::find()->where([
            'user_id' => $id,
            'token_id' => PushToken::findOne(['token' => $token])->id
        ])->one() === null ? false : true;

        return $result;
    }
}
