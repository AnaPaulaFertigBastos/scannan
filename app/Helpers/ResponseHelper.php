<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($data = null, $message = 'Sucesso', $code = 200)
    {
        return response()->json([
            'ok' => true,
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message = 'Erro', $code = 400)
    {
        return response()->json([
            'ok' => false,
            'success' => false,
            'message' => $message
        ], $code);
    }
}