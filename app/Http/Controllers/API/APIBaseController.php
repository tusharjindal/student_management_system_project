<?php

namespace App\Http\Controllers\API;
use App\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIBaseController extends Controller
{
    public function sendResponse_all_students($result,$previousLink,$nextLink,$pageSizeCurrent,$total_pages,$message)
    {        
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'next page URL' => $nextLink,
            'previous page URL' => $previousLink,
            'total records per page' => $pageSizeCurrent,
            'total pages' => $total_pages,
            ];
            return response()->json($response, 200);
        }

    public function sendResponse($result,$message)
    {        
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            ];
            return response()->json($response, 200);
        }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


}
