<?php

namespace app\models\service;

use Yii;
use yii\base\Model;
use app\models\Messages;
use app\models\Base;
use app\models\db\ProductAuthComplaint;
use app\models\UploadedFileCustom;

/**
 * Class Report
 * @package app\models\service
 */
class Report extends Model
{
    public $fio;
    public $email_phone;
    public $shop_name;
    public $shop_address;

    /**
     * @var UploadedFileCustom
     */
    public $product_photo;

    /**
     * @var UploadedFileCustom
     */
    public $cheque_photo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'email_phone', 'shop_name', 'shop_address'], 'required'],
            [['product_photo', 'cheque_photo'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fio' => 'ФИО',
            'email_phone' => 'Email или телефон',
            'shop_name' => 'Название магазина',
            'shop_address' => 'Адресс магазина',
            'product_photo' => 'Фото изделия (jpg, png)',
            'cheque_photo' => 'Фото чека (jpg, png)'
        ];
    }

    /**
     * @return mixed
     */
    public function uploadImages()
    {
        $result['msg'] = Messages::get('report_failed');
        $result['error'] = true;

        if ($this->validate()) {
            $this->product_photo->setImagePath('upload/service/product_authentication/complaint/product/');

            $success = $this->product_photo->saveAs(
                $this->product_photo->getImagePath() . $this->product_photo->encrypted_name
            );

            if ($success === false) {
                return $result;
            }

            $this->cheque_photo->setImagePath('upload/service/product_authentication/complaint/cheque/');

            $success = $this->cheque_photo->saveAs(
                $this->cheque_photo->getImagePath() . $this->cheque_photo->encrypted_name
            );

            if ($success === false) {
                unlink($this->product_photo->getImagePath() . $this->product_photo->encrypted_name);
                return $result;
            }

            $result['product_photo_id'] = Base::saveFile($this->prepareFileData($this->product_photo));
            $result['cheque_photo_id'] = Base::saveFile($this->prepareFileData($this->cheque_photo));
            $result['msg'] = Messages::get('report_success');
            $result['error'] = false;
        }

        return $result;
    }

    /**
     * @param UploadedFileCustom $file
     * @return mixed
     */
    private function prepareFileData(UploadedFileCustom $file)
    {
        $imageResolution = $file->getImageResolution();

        $data['file_name'] = $file->encrypted_name;
        $data['original_name'] = $file->name;
        $data['subdir'] = $file->getImagePath();
        $data['content_type'] = $file->type;
        $data['file_size'] = $file->size;
        $data['height'] = $imageResolution['height'];
        $data['width'] = $imageResolution['width'];

        return $data;
    }

    /**
     * @param array $data
     */
    public function saveComplaint(array $data)
    {
        $model = new ProductAuthComplaint();

        $model->user_id = Yii::$app->user->id;
        $model->fio = htmlspecialchars($this->fio);
        $model->email_phone = htmlspecialchars($this->email_phone);
        $model->shop_name = htmlspecialchars($this->shop_name);
        $model->shop_address = htmlspecialchars($this->shop_address);
        $model->product_photo_id = $data['product_photo_id'];
        $model->cheque_photo_id = $data['cheque_photo_id'];

        $model->save();
    }
}
