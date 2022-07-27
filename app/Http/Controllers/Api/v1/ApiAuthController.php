<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;
use App\Models\User;

class ApiAuthController extends CommonApiController
{
    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  CHECK USER LOGIN FROM APP
     * @date 2022-07-26
     */
    public function appUserLogin(Request $request) {
        try {
            CommonApiController::isJsonRequest($request);
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:45|exists:users',
                'password' => 'required|string|min:6',
            ]);
            $message = CommonApiController::checkValidation($validator);
            if($message){
                return CommonApiController::endRequest(false, 205, $message);
            }else{
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    if (Hash::check($request->password, $user->password)) {
                        $user_access_token = $user->createToken('Laravel Password Grant Client')->accessToken;
                        // dd($user);
                        $response = [
                            'user_access_token' => $user_access_token,
                            'user' => $user,
                        ];
                        return CommonApiController::endRequest(true, 200, 'Login successfully.', array($response));
                    }else{
                        return CommonApiController::endRequest(false, 205, 'Invalid Credentials.');
                    }
                } 
            }
        } catch (Exception $ex) {
            return CommonApiController::endRequest(false, 205, $ex->getMessage());
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USER LOGOUT FROM APP
     * @date 2022-07-26
     */
    public function appUserLogout(Request $request) {
        try {
            CommonApiController::isJsonRequest($request);
            $accessToken = auth()->user()->token();
            $token = $request->user()->tokens->find($accessToken);
            $token->revoke();
            return CommonApiController::endRequest(true, 200, 'User Logout Successfully.');
        } catch (Exception $ex) {
            return CommonApiController::endRequest(false, 205, $ex->getMessage());
        }
    }
}
