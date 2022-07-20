<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;

class RoleController extends Controller
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
     * @comment  Roles INDEX PAGE
     * @date 2022-07-13
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $create = Role::all();
        return view('roles.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Roles Listing PAGE
     * @date 2022-07-13
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = Role::all()->toarray();
            // $created_at = $data['created_at'];
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return getBtnHtml($row, 'roles', true, true);
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
     * @comment  Roles create PAGE
     * @date 2022-07-13
     */
    public function create(Request $request) {
        return view('roles.update');
    }
    /*
    * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Roles INSERT RECORDS
     * @date 2022-07-13
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'name' => 'required|alpha|min:2|max:20|unique:roles,name,' . $request->id . ',id,deleted_at,NULL',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $role = Role::find($request->id);
            insertSystemLog('Update Role From Web',auth()->user()->name,$request->header('user-agent'));
        } else {
            $role = new Role();
            insertSystemLog('Insert Role From Web',auth()->user()->name,$request->header('user-agent'));
        }
        $role->name = $request->name;
        $role->save();
        if($role){
            Toastr::success('Role updated successfully.', 'Success');
            return Redirect::route('roles.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Roles edit PAGE
     * @date 2022-07-13
     */
    public function edit(Request $request, Role $role) {
        return view('roles.update')
                        ->with('role', $role);
    }
     /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Roles delete Records
     * @date 2022-07-13
     */
    public function destroy(Request $request) {
        $record = Role::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete Role From Web',auth()->user()->name,$request->header('user-agent'));
                return endRequest('Success', 200, 'Record deleted successfully.');
            } else {
                return endRequest('Error', 205, 'Record not found.');
            }
    }
}
