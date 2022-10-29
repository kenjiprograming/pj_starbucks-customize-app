<?php
declare(strict_types=1);

class DrinkModel extends CI_Model
{
    public const DRINK_API_URL = 'https://product.starbucks.co.jp/api/category-product-list/beverage/index.json';
    public const DRINK_DATA_PATH = FCPATH . 'data/drinkData.json';

    private array $drinkData = [];

    public function __construct()
    {
        $this->setDrinkData();
    }


    // ---------------------Getter----------------------------------------------------------------------------------


    public function getDrinkData()
    {
        return $this->drinkData;
    }


    // ---------------------Setter----------------------------------------------------------------------------------


    private function setDrinkData()
    {
        $json = file_get_contents(self::DRINK_DATA_PATH);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

        try {
            $this->drinkData = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            echo 'drinkData.jsonの読み取りに失敗しました。';
            exit();
        }
    }


    // ---------------------Unique----------------------------------------------------------------------------------


    public function knockDrinkAPI()
    {
        $json = file_get_contents(self::DRINK_API_URL);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

        try {
            $apiRawData = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            echo 'Api関連でエラーが生じました。';
            exit();
        }

        $this->marshalApiRawData($apiRawData);
    }

    private function marshalApiRawData(array $apiRawData)
    {
        $marshaledApiData = array_map(static function ($apiRawDatum) {
            return [
                'id' => $apiRawDatum['id'],
                'name' => $apiRawDatum['product_name'],
                'kindEn' => $apiRawDatum['category2_list_path'],
                'kindJp' => $apiRawDatum['category2_name'],
                'price' => $apiRawDatum['price'],
                'size' => $apiRawDatum['size'],
                'imageUrl' => 'https://product.starbucks.co.jp' . $apiRawDatum['image1'],
                'chunkProducts' => array_map(static function ($chunkProduct) use ($apiRawDatum) {
                    return [
                        'name' => $chunkProduct['product_name'],
                        'kindEn' => $chunkProduct['category2_list_path'],
                        'kindJp' => $chunkProduct['category2_name'],
                        'price' => $chunkProduct['price'],
                        'size' => $chunkProduct['size'],
                        'imageUrl' => 'https://product.starbucks.co.jp' . $apiRawDatum['image1'],
                    ];
                }, $apiRawDatum['chunk_products']),
            ];
        }, $apiRawData);

        $this->generateDrinkDataJson($marshaledApiData);
    }

    private function generateDrinkDataJson($marshaledApiData)
    {
        try
        {
            $json = json_encode($marshaledApiData, JSON_THROW_ON_ERROR);
            $bytes = file_put_contents(FCPATH . "data/drinkData.json", $json);
            log_message("debug", "generate $bytes bytes of Drink Data File");
        }
        catch (JsonException $e) {
            echo 'Drink Data File の作成に失敗しました。';
            exit();
        }
    }

}