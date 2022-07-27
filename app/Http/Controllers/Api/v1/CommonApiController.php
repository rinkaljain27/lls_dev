<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CommonApiController extends Controller {
    /*
     * @category WEBSITE
     * @author Original Author ksanghavi@moba.de
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  END API REQUEST
     * @date 2021-10-18
     */

    public function endRequest($status, $responseCode, $responseMessage, $data = '') {
        $response['responseStatus'] = $status;
        $response['responseCode'] = $responseCode;
        $response['responseMessage'] = $responseMessage;
        $response['data'] = $data;
        return json_encode($response);
    }

    /*
     * @category WEBSITE
     * @author Original Author ksanghavi@moba.de
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  CHECK JSON REQUEST
     * @date 2021-10-18
     */

    public function isJsonRequest($request) {
        if (!$request->isJson()) {
            //NOT VALID INPUT
            $response['status'] = 0;
            $response['responseCode'] = 205;
            $response['responseMessage'] = "No direct script access allowed.";
            return json_encode($response);
        }
    }

    /*
     * @category WEBSITE
     * @author Original Author ksanghavi@moba.de
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  CHECK REQUEST VALIDATION
     * @date 2021-10-18
     */

    public function checkValidation($validator) {
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            // $this->endRequest(false, 205, $message);
            return $message;
        }
    }

    /*
     * @category WEBSITE
     * @author Original Author ksanghavi@moba.de
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  CHECK USER IS VALIDATE OR NOT
     * @date 2021-11-09
     */

    public function checkvalidateUser($userid) {
        $user = auth()->user();
        
        if ($userid != $user->userid) {
            CommonApiController::endRequest(true, 200, 'No user found.', array());
        }
    }

}
