<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\SystemLogs;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Login from web page
     * @date 2022-07-13
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {  
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            insertSystemLog('Web Login',auth()->user()->name.' logged In From Web App',$request->header('user-agent'));

            if (auth()->user()) {
                $user = auth()->user()->toarray();
                $request->session()->put('user', $user);
                // $data = $request->session()->all();
                // printData($data);
                Toastr::success('Login successfully.', 'Success');
                return Redirect::route('home');
            }else{
                Toastr::error('Invalid Credentials.', 'Error');
                return Redirect::back();
            }
        }else{
            Toastr::error('Invalid Credentials.', 'Error');
            return Redirect::back();
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Logout page from web
     * @date 2022-07-13
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function logout(Request $request)
    {  
        insertSystemLog('Web Logout',auth()->user()->name.' logged Out From Web App',$request->header('user-agent'));       
        auth()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Toastr::success('Logout successfully.', 'Success');
        return Redirect::route('login');
    }
    
}
