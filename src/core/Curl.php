<?php

namespace Vkrsmart\Sdk\Core;

use CURLFile;

class Curl
{
    const API = 'http://api.bse.vkr-smart.ru:8004';

//    const X_API_KEY = '';

    /**
     * Отправка запроса
     * @param $apiMethod
     * @param $auth
     * @param array $params
     * @return array|mixed
     */
    public static function exec($apiMethod, $auth, array $params)
    {
        if (!empty($params)) {
            $apiMethod = sprintf("%s?%s", $apiMethod, http_build_query($params, '', '&'));
        };

        $headers = array(
            'Authorization: Bearer ' . $auth,
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'Accept: application/json'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_URL, self::API . $apiMethod);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        if(array_key_exists('file_path',$params)){
            curl_setopt($curl, CURLOPT_POSTFIELDS, [
                'file' => new CURLFile($params['file_path'], '')
            ]);
        }

        $curlResult = curl_exec($curl);

        if (curl_errno($curl)) {
            return Curl::error('Curl error ' . curl_errno($curl) . ': ' . curl_error($curl), 500);
        }
        return json_decode($curlResult, true);
    }


    /**
     * Возврат error сообщения в json
     * @param $message
     * @param $code
     * @return false|string
     */
    public static function error($message, $code)
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
