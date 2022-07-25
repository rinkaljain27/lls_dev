<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role; 
use App\Models\User; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USERS INDEX PAGE
     * @date 2022-07-18
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $create = User::all();
        return view('users.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USERS LISTING PAGE
     * @date 2022-07-18
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = User::all()->toarray();
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return getBtnHtml($row, 'users', true, true);
                    })
                    ->addColumn('created_at', function($row){
                        $date = date('d/m/Y H:i:s', strtotime($row['created_at']));
                        return $date;
                    })
                    ->addColumn('status', function ($row) {
                        return formatStatusColumn($row);
                    })
                    ->rawColumns(['status','action'])
                    ->toJson();
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USERS CREATE PAGE
     * @date 2022-07-18
     */
    public function create(Request $request) {
        $role = Role::all();
        return view('users.update')->with('role', $role);
    }
    /*
    * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USERS INSERT RECORDS
     * @date 2022-07-18
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'name' => 'required|min:2|max:20|unique:users,name,' . $request->id . ',id,deleted_at,NULL',
            'role_id' => 'required',
            'full_name' => 'required|min:2|max:70',
            'email' => 'required|min:2|max:70|unique:users,email,' . $request->id . ',id,deleted_at,NULL',
            'mobile' => 'required',
            'address' => 'required',
            'password' => 'required_with:c_password|same:c_password|min:6|max:25',
            'c_password' => 'min:6|max:25',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $user = User::find($request->id);
            insertSystemLog('Update User From Web App',ucfirst(auth()->user()->name).' Update User From Web App',$request->header('user-agent'));
        } else {
            $user = new User();
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');
            insertSystemLog('Insert User From Web App',ucfirst(auth()->user()->name).' Insert User From Web App',$request->header('user-agent'));
        }
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        if ($request->password == ''){
            $password = Hash::make('password');
        }
        $user->password = $password;
        // dd($user);
        $user->save();
        if($user){
            Toastr::success('User updated successfully.', 'Success');
            return Redirect::route('users.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USERS EDIT PAGE
     * @date 2022-07-18
     */
    public function edit(Request $request, User $user) {
        $role = Role::all();
        return view('users.update')
                        ->with('user', $user)
                        ->with('role', $role);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USERS DELETE RECORDS
     * @date 2022-07-18
     */
    public function destroy(Request $request) {
        $record = User::where('id', $request->id)->update(['is_active' => 0 , 'deleted_at' => date('Y-m-d H:i:s')]);
        // $record = User::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete User From Web App',ucfirst(auth()->user()->name).' Delete User From Web App',$request->header('user-agent'));
                return endRequest('Success', 200, 'Record Deleted Successfully.');
            } else {
                return endRequest('Error', 205, 'Record Not Found.');
            }
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  CHANGE STATUS FUNCTION
     * @date 2022-07-25
     */
    public function updateStatus(Request $request) {
        $values = array(
            'is_active' => $request->val,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $record = User::where('id', $request->id)->update($values);
        if ($record) {
            return endRequest('Success', 200, 'Status Updated Successfully.');
        } else {
            return endRequest('Error', 205, 'Something Went Wrong.');
        }
    }
   /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  USER PROFILE INDEX PAGE
     * @date 2022-07-25
     */

    public function profile() {
        $userid = Session::get('user.id');
        $user = User::where('id', $userid)->where('is_active', 1)->first();
        return view('users.profile')->with('user', $user);
    }
   /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  UPDATE USER PROFILE
     * @date 2022-07-25
     */
    public function updateProfile(Request $request) {
        $input = $request->all();
        $validate = [
            'name' => 'required|min:2|max:20|unique:users,name,' . $request->id . ',id,deleted_at,NULL',
            'full_name' => 'required|min:2|max:70',
            'email' => 'required|min:2|max:70|unique:users,email,' . $request->id . ',id,deleted_at,NULL',
            'mobile' => 'required',
            'password' => 'required_with:c_password|same:c_password|min:6|max:25',
            'c_password' => 'min:6|max:25',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::route('profile');
        }
        if ($request->id) {
            $user = auth()->user();
            $userid = $request->id;
            $userData = [
                "name" => $request->name,
                "full_name" => $request->full_name,
                "email" => $request->email,
                "mobile" => $request->mobile,
                "password" => Hash::make('password'),
            ];
            // dd($userData);
            User::where('id', $userid)
                        ->update($userData);
            Toastr::success('Profile Updated Successfully', 'Success');
            return Redirect::route('profile');
        }
    }
}
