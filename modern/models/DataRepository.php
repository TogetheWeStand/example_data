<?php

namespace app\models;

use yii\base\Model;

/**
 * Class DataRepository
 * @package app\models
 */
class DataRepository extends Model
{
    /**
     * @param string $result
     * @return mixed
     */
    private function decodeResult($result)
    {
        return json_decode($result, true)['hits']['hits'][0]['_source'];
    }

    /**
     * @param string $barcode
     * @return mixed|null
     */
    public function findBarcode($barcode)
    {
        $url = "http://elasticsearch:9200/barcodes/_search?q=BARCODE:$barcode";

        return $this->performCurl($url, Messages::get('incorrect_barcode'));
    }

    /**
     * @param string $article
     * @return mixed|null
     */
    public function findArticle($article)
    {
        $url = "http://elasticsearch:9200/products-b2b/_search?q=ARTICLE:" . $article;

        return $this->performCurl($url, Messages::get('no_article_data'));
    }

    /**
     * @param string $url
     * @param string $error_message
     * @return mixed|null
     */
    private function performCurl($url, $error_message)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

        $result = curl_exec($ch);
        curl_close($ch);

        $result = $this->decodeResult($result);

        if ($result === null) {
            $result['error'] = $error_message;
        }

        return $result;
    }
}
