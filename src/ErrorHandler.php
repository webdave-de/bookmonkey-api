<?php

class ErrorHandler
{
    public static function handleException($exc)
    {
        http_response_code(555);

        echo json_encode([
            "code" => $exc->getCode(),
            "message" => $exc->getMessage(),
            "file" => $exc->getFile(),
            "line" => $exc->getLine()
        ]);
    }
}