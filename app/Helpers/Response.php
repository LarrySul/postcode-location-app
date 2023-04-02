<?php


namespace App\Helpers;


class Response {

    public static function  setResponse($status, $data = null, $message = null, $error=null, $custom_errors=null)
    {
        $response = ['status' => $status];
        $data = request()->base64_response ? base64_encode(json_encode($data ?? [])) : $data;

        !is_null($data) && $response['data'] = $data;
        !is_null($message) && $response['message'] = $message;
        !is_null($error) && $response['error'] = $error;
        $response = request()->base64_body ? base64_encode(json_encode($response)) : $response;
        return response()->json(
            $response, $status
        );
    }
}