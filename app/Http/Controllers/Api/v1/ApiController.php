<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller
{

    protected function respond($data, $statusCode = Response::HTTP_OK, $headers = [])
    {
        return response()->json($data, $statusCode, $headers);
    }

    protected function respondWithMessage($message, $statusCode, $headers = [])
    {
        return $this->respond([
            'message' => $message
        ], $statusCode, $headers);
    }

    protected function respondSuccess($data, $statusCode = Response::HTTP_OK, $headers = [])
    {
        return $this->respondWithMessage($data, $statusCode, $headers);
    }

    protected function respondNotFound($message = 'Not Found')
    {
        return $this->respondWithMessage($message, Response::HTTP_NOT_FOUND);
    }

    protected function respondError($message, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        return $this->respondWithMessage($message, $statusCode);
    }

}