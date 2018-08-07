<?php

use yii\db\Migration;
use app\models\User;
use yii\db\Expression;

/**
 * Class M180724115118UserData
 */
class M180724115118UserData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        ini_set('memory_limit', '-1');

        $exchangeVals = [
            'PERSONAL_GENDER' => 'gender',
            'SECOND_NAME' => 'patronymic',
            'LAST_NAME' => 'surname',
            'PERSONAL_BIRTHDAY' => 'birthday',
        ];
        $limit = 100000;
        $step = 0;
        $connection = Yii::$app->db_mysql;

        while(true) {
            $offset = $step * $limit;

            $sql = "SELECT distinct u.* FROM b_user u
            LEFT JOIN b_group g ON (g.`STRING_ID` LIKE 'My%')
            LEFT JOIN b_user_group ug ON (ug.`GROUP_ID` = g.`ID`)
            WHERE u.`ACTIVE` = 'Y'
            AND u.`ID` = ug.`USER_ID` LIMIT $limit OFFSET $offset";

            $bxMyUsers = $connection->createCommand($sql)->queryAll();

            if (!count($bxMyUsers)) {
                echo "more records not found";
                break;
            }

            foreach ($bxMyUsers as $bxMyUser) {
                $user = new User();

                foreach ($bxMyUser as $code => $value) {
                    if (array_key_exists($code, $exchangeVals)) {
                        $code = $exchangeVals[$code];
                    } elseif ($code !== "BX_USER_ID") {
                        $code = strtolower($code);
                    } else {
                        continue;
                    }

                    $user->$code = $value;
                }

                $user->save();
            }

            $step++;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "M180724115118UserData cannot be reverted.\n";

        return false;
    }
}
