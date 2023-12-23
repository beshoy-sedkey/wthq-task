<?php
namespace App\Traits;


trait ResponseMethod
{

    protected $messagesSuccess = [
        200 => 'The request was successful',
        201 => 'Resource created successfully',
        202 => 'The request was accepted and is being processed asynchronously',
    ];

    protected $messagesError = [
        400 => 'Bad Request: The server could not understand the request',
        401 => 'Unauthorized: Authentication is required and has failed or has not been provided',
        403 => 'Forbidden: The server understood the request, but it refuses to authorize it',
        404 => 'Not Found: The requested resource could not be found',
        405 => 'Method Not Allowed: The method received in the request-line is known by the origin server but not supported',
        410 => 'Gone: The requested resource is no longer available and will not be available again',
        411 => 'Length Required: The server refuses to accept the request without a defined Content-Length',
        500 => 'Internal Server Error: A generic error message returned when an unexpected condition was encountered',
        503 => 'Service Unavailable: The server is not ready to handle the request',
        422 => 'Unprocessable Entity: The server understands the content type of the request entity but was unable to process the contained instructions',
    ];


    public function responseSuccess($data = null, string $message = null, int $statusCode = 200)
    {
        return response()->json([
            "message" => $message ?? $this->messagesSuccess[$statusCode],
            "data" => $data
        ], $statusCode);
    }

    public function responseWithoutData(string $message = null, int $statusCode = 200){
        return response()->json([
            "message" => $message ?? $this->messagesSuccess[$statusCode],
        ], $statusCode);
    }

    public function responseError(string $message = null, int $statusCode = 422)
    {

        return response()->json([
            "message" => $message ?? $this->messagesError[$statusCode],
        ], $statusCode);

    }

    public function responseException($exception)
    {
        return response()->json([
            "message" => $exception->getMessage(),
            "line" => $exception->getLine(),
            "file" => $exception->getFile(),
            "code" => $exception->getCode(),
        ], 500);

    }
}
