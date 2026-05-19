<?php

if(! function_exists('apiResponse')){
    function apiResponse($code , $message ,$data = null){
        $response = ['messag'=>$message];
        if($data)
        {
            $response['data'] = $data;
        }
        return response()->json($response, $code);
    }
}
