<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected function success($data = null, $message = null, $code = 200)
    {
        $response = [
            'success' => true,
        ];

        if($message !== null) {
            $response['message'] = $message;
        }

        if($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    protected function error($message = null, $code = 400)
    {
        $response = [
            'success' => false,
        ];

        if($message !== null) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

    protected function formatPagination($paginator)
    {
        return [
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'from' => $paginator->firstItem(),
            'to' => $paginator->lastItem()
        ];
    }
}
