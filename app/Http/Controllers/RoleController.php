<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role; 
use App\Models\Command; 
use App\Models\Permission; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;
use Illuminate\Support\Facades\Auth;

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
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES INDEX PAGE
     * @date 2022-07-13
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        checkPermissions('roles-view');
        $create = checkPermissions('roles-create', true);
        return view('roles.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES LISTING PAGE
     * @date 2022-07-13
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = Role::all()->toarray();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $user = Auth::user();
                        return getBtnHtml($row, 'roles', $user->hasRole('admin'), checkPermissions('roles-edit', true), checkPermissions('roles-delete', true));
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
     * @comment  ROLES CREATE PAGE
     * @date 2022-07-13
     */
    public function create(Request $request) {
        checkPermissions('roles-create');
        $command = Command::all()->where('is_active',1);
        $permission = Permission::all()->where('is_active',1);
        return view('roles.update')->with('command',$command)->with('permission',$permission);
    }
    /*
    * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES INSERT RECORDS
     * @date 2022-07-13
     */
    public function store(Request $request, Role $role) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'name' => 'required|min:2|max:20|unique:roles,name,' . $request->id . ',id,deleted_at,NULL',
            'commands' => 'required',
            'permissions' => 'required',
        ];

        $commands = removeArrayElement($request->commands);
        $permissions = removeArrayElement($request->permissions);
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $role = Role::find($request->id);
            $old_commands = $role->getCommandIds();
            $role->commands()->detach($old_commands);

            $old_permissions = $role->getPermissionIds();
            $role->permissions()->detach($old_permissions);
            insertSystemLog('Update Role From Web App',ucfirst(auth()->user()->name).' Update Role From Web App',$request->header('user-agent'));
        } else {
            $role = new Role();
            $role->created_at = date('Y-m-d H:i:s');
            $role->updated_at = date('Y-m-d H:i:s');
            insertSystemLog('Insert Role From Web App',ucfirst(auth()->user()->name).' Insert Role From Web App',$request->header('user-agent'));
        }
        $role->name = $request->name;
        $role->save();
        $role->commands()->attach($commands);
        $role->permissions()->attach($permissions);
        if($role){
            Toastr::success('Role Updated Successfully.', 'Success');
            return Redirect::route('roles.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES EDIT PAGE
     * @date 2022-07-13
     */
    public function edit(Request $request, Role $role) {
        checkPermissions('roles-edit');
        $command = Command::all()->where('is_active',1);
        $permission = Permission::all()->where('is_active',1);
        $role_command = $role->getCommandIds();
        $role_permission = $role->getPermissionIds();
        return view('roles.update')
                        ->with('role', $role)->with('command', $command)->with('permission', $permission)
                        ->with('role_command', $role_command)->with('role_permission',$role_permission);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES DELETE RECORDS
     * @date 2022-07-13
     */
    public function destroy(Request $request) {
        checkPermissions('roles-delete');
        $record = Role::where('id', $request->id)->update(['is_active' => 0 , 'deleted_at' => date('Y-m-d H:i:s')]);
        // $record = Role::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete Role From Web App',ucfirst(auth()->user()->name).' Delete Role From Web App',$request->header('user-agent'));
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
        $record = Role::where('id', $request->id)->update($values);
        if ($record) {
            return endRequest('Success', 200, 'Status updated successfully.');
        } else {
            return endRequest('Error', 205, 'Something went wrong.');
        }
    }
}
