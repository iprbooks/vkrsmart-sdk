<?php

namespace Vkrsmart\Sdk\Core;

use CURLFile;

class Curl
{
    const API = '';

    const X_API_KEY = '';

    /**
     * Отправка запроса
     * @param $apiMethod
     * @param $token
     * @param array $params
     * @return array|mixed
     */
    public static function exec($apiMethod, $token, array $params)
    {
        if (!empty($params)) {
            $apiMethod = sprintf("%s?%s", $apiMethod, http_build_query($params, '', '&'));
        };

        $headers = array(
            'Authorization: Bearer ' . $token,
            'X-APIKey: ' . self::X_API_KEY,
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
            return Curl::getError('Curl error ' . curl_errno($curl) . ': ' . curl_error($curl), 500);
        }
        return json_decode($curlResult, true);
    }


    /**
     * Вормирование сообщения в случае ошибки
     * @param $message
     * @param $code
     * @return array
     */
    private static function getError($message, $code): array
    {
        return array(
            'success' => false,
            'message' => $message,
            'total' => 0,
            'status' => $code,
            'data' => null,
        );
    }
}
