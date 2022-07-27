<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;

class PermissionController extends Controller
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
     * @comment  PERMISSION INDEX PAGE
     * @date 2022-07-25
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $create = Permission::all();
        return view('permissions.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PERMISSION LISTING PAGE
     * @date 2022-07-25
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = Permission::all()->toarray();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return getBtnHtml($row, 'permissions', true, true);
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
     * @comment  PERMISSION CREATE PAGE
     * @date 2022-07-25
     */
    public function create(Request $request) {
        return view('permissions.update');
    }
    /*
    * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PERMISSION INSERT RECORDS
     * @date 2022-07-25
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'permission_name' => 'required|min:2|max:20|unique:permissions,permission_name,' . $request->id . ',id,deleted_at,NULL',
            'permission_slug' => 'required|min:2|max:20|unique:permissions,permission_slug,' . $request->id . ',id,deleted_at,NULL',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $permission = Permission::find($request->id);
            insertSystemLog('Update Permission From Web App',ucfirst(auth()->user()->name).' Update Permission From Web App',$request->header('user-agent'));
        } else {
            $permission = new Permission();
            $permission->created_at = date('Y-m-d H:i:s');
            $permission->updated_at = date('Y-m-d H:i:s');
            insertSystemLog('Insert Permission From Web App',ucfirst(auth()->user()->name).' Insert Permission From Web App',$request->header('user-agent'));
        }
        $permission->permission_name = $request->permission_name;
        $permission->permission_slug = $request->permission_slug;
        $permission->save();
        if($permission){
            Toastr::success('Permission Updated Successfully.', 'Success');
            return Redirect::route('permissions.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PERMISSION EDIT PAGE
     * @date 2022-07-25
     */
    public function edit(Request $request, Permission $permission) {
        return view('permissions.update')
                        ->with('permission', $permission);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PERMISSION DELETE RECORDS
     * @date 2022-07-25
     */
    public function destroy(Request $request) {
        $record = Permission::where('id', $request->id)->update(['is_active' => 0 , 'deleted_at' => date('Y-m-d H:i:s')]);
        // $record = Permission::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete Permission From Web App',ucfirst(auth()->user()->name).' Delete Permission From Web App',$request->header('user-agent'));
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
        $record = Permission::where('id', $request->id)->update($values);
        if ($record) {
            return endRequest('Success', 200, 'Status updated successfully.');
        } else {
            return endRequest('Error', 205, 'Something went wrong.');
        }
    }
}
