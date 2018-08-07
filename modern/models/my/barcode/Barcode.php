<?php

namespace app\models\my\barcode;

use Yii;
use yii\base\Model;
use app\models\Messages;
use app\models\DataRepository;
use app\models\db\UserBarcode;

/**
 * Class Barcode
 * @package app\models\my\barcode
 */
class Barcode extends Model
{
    public $barcode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['barcode'], 'required'],
            [['barcode'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ['barcode' => 'Штрихкод'];
    }

    /**
     * @return mixed|null
     */
    public function getRegistrationData()
    {
        $barcode = htmlspecialchars($this->barcode);

        $model = new DataRepository();

        if ($this->alreadyExists($barcode) === null) {
            $result = $model->findBarcode($barcode);

            if (!empty($result['error'])) {
                return $result;
            }

            $data['barcode'] = $result['BARCODE'];
            $data['article'] = $result['ARTICLE'];
            $data['type'] = $result['PRODUCT_TYPE'];

            $result = $model->findArticle($result['ARTICLE']);

            if (!empty($result['error'])) {
                return $result;
            }

            $data['type_metall'] = $result['MATERIAL']['NAME'];
            $data['sales_department'] = $result['SALES_DEPARTMENT']['CODE'];
        } else {
            $data['error'] = Messages::get('already_exists_barcode');
        }

        return $data;
    }

    /**
     * @param string $barcode
     * @return array|null|\yii\db\ActiveRecord
     */
    private function alreadyExists($barcode)
    {
        $model = new UserBarcode();

        return $model->find()->where("barcode='$barcode'")->one();
    }

    /**
     * @param array $data
     */
    public function registerBarcode(array $data)
    {
        $model = new UserBarcode();

        $model->barcode = $data['barcode'];
        $model->article = $data['article'];
        $model->user_id = Yii::$app->user->id;
        $model->type = $data['type'];
        $model->type_metall = $data['type_metall'];
        $model->sales_department = $data['sales_department'];
        $model->manual_registration = false;

        $model->save();
    }
}
