<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role; 
use App\Models\User; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
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
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Users INDEX PAGE
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
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  User Listing PAGE
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
                        $date = date('Y/m/d H:i:s', strtotime($row['created_at']));
                        return $date;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Users create PAGE
     * @date 2022-07-18
     */
    public function create(Request $request) {
        $role = Role::all();
        return view('users.update')->with('role', $role);
    }
    /*
    * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Users INSERT RECORDS
     * @date 2022-07-18
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'name' => 'required|alpha|min:2|max:20|unique:users,name,' . $request->id . ',id,deleted_at,NULL',
            'role_id' => 'required',
            'full_name' => 'required|min:2|max:70',
            'email' => 'required|min:2|max:70|unique:users,email,' . $request->id . ',id,deleted_at,NULL',
            'mobile' => 'required',
            'address' => 'required',
            'password' => 'min:2|max:25',
           
        
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $user = User::find($request->id);
            insertSystemLog('Update User From Web',auth()->user()->name,$request->header('user-agent'));
        } else {
            $user = new User();
            insertSystemLog('Insert User From Web',auth()->user()->name,$request->header('user-agent'));
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
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Users edit PAGE
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
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Users delete Records
     * @date 2022-07-18
     */
    public function destroy(Request $request) {
        $record = User::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete User From Web',auth()->user()->name,$request->header('user-agent'));
                return endRequest('Success', 200, 'Record deleted successfully.');
            } else {
                return endRequest('Error', 205, 'Record not found.');
            }
    }
}
