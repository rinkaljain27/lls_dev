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
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES INDEX PAGE
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
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES LISTING PAGE
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
                    ->addColumn('status', function($row){
                        if($row['is_active'] == 1) {
                            return 'Active';
                        }
                    })
                    ->addColumn('created_at', function($row){
                        $date = date('d/m/Y H:i:s', strtotime($row['created_at']));
                        return $date;
                    })
                    ->addColumn('updated_at', function($row){
                        $date = date('d/m/Y H:i:s', strtotime($row['updated_at']));
                        return $date;
                    })
                    ->rawColumns(['action'])
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
        return view('roles.update');
    }
    /*
    * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  ROLES INSERT RECORDS
     * @date 2022-07-13
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'name' => 'required|min:2|max:20|unique:roles,name,' . $request->id . ',id,deleted_at,NULL',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $role = Role::find($request->id);
            insertSystemLog('Update Role From Web App',ucfirst(auth()->user()->name).' Update Role From Web App',$request->header('user-agent'));
        } else {
            $role = new Role();
            $role->created_at = date('Y-m-d H:i:s');
            $role->updated_at = date('Y-m-d H:i:s');
            insertSystemLog('Insert Role From Web App',ucfirst(auth()->user()->name).' Insert Role From Web App',$request->header('user-agent'));
        }
        $role->name = $request->name;
        $role->save();
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
        return view('roles.update')
                        ->with('role', $role);
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
        $record = Role::where('id', $request->id)->update(['is_active' => 0 , 'deleted_at' => date('Y-m-d H:i:s')]);
        // $record = Role::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete Role From Web App',ucfirst(auth()->user()->name).' Delete Role From Web App',$request->header('user-agent'));
                return endRequest('Success', 200, 'Record Deleted Successfully.');
            } else {
                return endRequest('Error', 205, 'Record Not Found.');
            }
    }
}
