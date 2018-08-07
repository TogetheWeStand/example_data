<?php

use yii\db\Migration;
//use app\models\my\barcode\UserBarcode;

/**
 * Class M180621085702UserBarcodeData
 */
class M180621085702UserBarcodeData extends Migration
{
    /**
     * Time to up approximately 90min
     * {@inheritdoc}
     */
//    public function up()
//    {
//        $command = Yii::$app->db_mysql;
//        $oldData = $command->createCommand("SELECT * FROM my_user_barcodes")->queryAll();
//
//        foreach ($oldData as $items) {
//            $barcode = new UserBarcode();
//
//            foreach ($items as $code => $value) {
//                $code = strtolower($code);
//                $barcode->$code = $value;
//            }
//
//            $barcode->save();
//        }
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function down()
//    {
//        echo "m180621085702UserBarcodeData cannot be reverted.\n";
//
//        return false;
//    }

    /**
     * Time to up approximately 30min
     * @return bool|void
     */
    public function safeUp()
    {
        $handle = fopen(__DIR__ . '/sokolov_my_user_barcodes.sql', 'r');

        $pattern = [
            '/`my_user_barcodes`/',
            '/`ID`/',
            '/`BARCODE`/',
            '/`ARTICLE`/',
            '/`USER_ID`/',
            '/`DATE_CREATE`/',
            '/`TYPE`/',
            '/`TYPE_METALL`/',
            '/`SALES_DEPARTMENT`/',
            '/`manual_registration`/',
            '/,0\)/',
            '/,1\)/'
        ];
        $replacement = [
            'my.user_barcode',
            'id',
            'barcode',
            'article',
            'user_id',
            'date_create',
            'type',
            'type_metall',
            'sales_department',
            'manual_registration',
            ',false)',
            ',true)'
        ];

        while($string = fgets($handle)) {
            $string = preg_replace($pattern, $replacement, $string);
            $this->execute($string);
        }
    }
}
