<?php

namespace Vkrsmart\Sdk\Core;

use CURLFile;
use Exception;
use Illuminate\Support\Facades\Log;
class Curl
{
    const API = 'https://api.bse.dev.vkr-smart.ru';


    /**
     * Отправка запроса
     * @param $apiMethod
     * @param $auth
     * @param array $params
     * @param string $method
     * @return array
     * @throws Exception
     */
    public static function exec($apiMethod, $auth, array $params,string $method="GET"):array|string
    {
        $headers = array(
            'Authorization: Bearer ' . $auth,
            'Content-Type: multipart/form-data',
            'Accept: application/json'
        );
        $curl = curl_init();
        if($method!="GET" and $method!="POST"){
            throw new Exception("Incorrect method. Should be POST or GET");
        }
        //Для файлов полученных напрямую через request
        if(array_key_exists('file',$params)){
            curl_setopt($curl, CURLOPT_POST, 1);
            $file =  $params['file'];
            curl_setopt($curl, CURLOPT_POSTFIELDS, [
                'file' => curl_file_create($file->getPathname(), $file->getClientMimeType(), $file->getClientOriginalName())
            ]);
            unset($params['file']);
        }
        //Для файлов, загруженных с сервера
        elseif (array_key_exists('file_path',$params)){
            $filePath = $params['file_path'];
            $file = new CURLFile($filePath);
            curl_setopt($curl, CURLOPT_POSTFIELDS,['file' => curl_file_create($filePath)]);
            unset($params['file_path']);
        }
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        if (!empty($params)) {
            $apiMethod = sprintf("%s?%s", $apiMethod, http_build_query($params, '', '&'));
        }

        Log::debug('Api method - '.$apiMethod);

        curl_setopt($curl, CURLOPT_URL, self::API .$apiMethod);

        $curlResult = curl_exec($curl);
        Log::debug('Curl result - '.$curlResult);

        curl_close($curl);

        if (curl_errno($curl)) {
            $curlResult =  Curl::error('Curl error ' . curl_errno($curl) . ': ' . curl_error($curl), 500);
        }

        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        // Проверка на HTTP-статус
        if ($httpCode >= 400) {
            return Curl::error("API вернуло ошибку: $httpCode", $httpCode);
        }

        $result = json_decode($curlResult, true);

        if($result==null){
             return Curl::error('API вернуло null',403);
        }

        return $result;
    }

    /**
     * Возврат error сообщения в json
     * @param $message
     * @param $code
     * @return string
     */
    public static function error($message, $code): string
    {
        return json_encode([
                'success' => false,
                'message' => $message,
                'total' => 0,
                'status' => $code,
                'data' => null
            ]
        );
    }

}
