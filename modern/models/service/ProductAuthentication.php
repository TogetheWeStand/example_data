<?php

namespace app\models\service;

use yii\base\Model;

/**
 * Class ProductAuthentication
 * @package app\models\service
 */
class ProductAuthentication extends Model
{
    public $barcode;
    public $article;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['barcode', 'article'], 'required'],
            [['barcode'], 'string', 'max' => 13],
            [['article'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'barcode' => 'Штрихкод',
            'article' => 'Артикул'
        ];
    }
}
