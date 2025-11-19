<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    /**
     * Success response method.
     *
     * @param  mixed  $result
     * @param  string  $message
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'status' => true,
            'response' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * Return error response.
     *
     * @param  string  $error
     * @param  array  $errorMessages
     * @param  int  $code
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];

        return response()->json($response, $code);
    }
}
