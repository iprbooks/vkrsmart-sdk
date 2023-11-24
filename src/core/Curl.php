<?php

namespace Vkrsmart\Sdk\Core;

use Exception;

class Curl
{
    const API = 'http://api.bse.vkr-smart.ru:8004';

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
        if($method=="POST" and array_key_exists('file',$params)){
            curl_setopt($curl, CURLOPT_POST, 1);
            $file =  $params['file'];
            curl_setopt($curl, CURLOPT_POSTFIELDS, [
                'file' => curl_file_create($file->getPathname(), $file->getClientMimeType(), $file->getClientOriginalName())
            ]);
            unset($params['file']);
        }
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        if (!empty($params)) {
//            $apiMethod = sprintf("%s?%s", $apiMethod, http_build_query($params, '', '&'));
//        }
        curl_setopt($curl, CURLOPT_URL, self::API .$apiMethod);

        $curlResult = curl_exec($curl);
        if($curlResult==null){
            throw new Exception('API вернуло null');
        }
        curl_close($curl);
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
