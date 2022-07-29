<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;
use Illuminate\Support\Facades\Auth;

class CommandController extends Controller
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
     * @comment  COMMAND INDEX PAGE
     * @date 2022-07-25
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        checkPermissions('commands-view');
        $create = checkPermissions('commands-create', true);
        return view('commands.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  COMMAND LISTING PAGE
     * @date 2022-07-25
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = Command::all()->toarray();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $user = Auth::user();
                        return getBtnHtml($row, 'commands', $user->hasRole('admin'), checkPermissions('commands-edit', true), checkPermissions('commands-delete', true));
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
     * @comment  COMMAND CREATE PAGE
     * @date 2022-07-25
     */
    public function create(Request $request) {
        checkPermissions('commands-create');
        return view('commands.update');
    }
    /*
    * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  COMMAND INSERT RECORDS
     * @date 2022-07-25
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'command_name' => 'required|min:2|max:20|unique:commands,command_name,' . $request->id . ',id,deleted_at,NULL',
            'command_url' => 'required|min:2|max:99|unique:commands,command_url,' . $request->id . ',id,deleted_at,NULL',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $command = Command::find($request->id);
            insertSystemLog('Update Command From Web App',ucfirst(auth()->user()->name).' Update Command From Web App',$request->header('user-agent'));
        } else {
            $command = new Command();
            $command->created_at = date('Y-m-d H:i:s');
            $command->updated_at = date('Y-m-d H:i:s');
            insertSystemLog('Insert Command From Web App',ucfirst(auth()->user()->name).' Insert Command From Web App',$request->header('user-agent'));
        }
        $command->command_name = $request->command_name;
        $command->command_url = $request->command_url;
        $command->save();
        if($command){
            Toastr::success('Command Updated Successfully.', 'Success');
            return Redirect::route('commands.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  COMMAND EDIT PAGE
     * @date 2022-07-25
     */
    public function edit(Request $request, Command $command) {
        checkPermissions('commands-edit');
        return view('commands.update')
                        ->with('command', $command);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  COMMAND DELETE RECORDS
     * @date 2022-07-25
     */
    public function destroy(Request $request) {
        checkPermissions('commands-delete');
        $record = Command::where('id', $request->id)->update(['is_active' => 0 , 'deleted_at' => date('Y-m-d H:i:s')]);
        // $record = Command::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete Command From Web App',ucfirst(auth()->user()->name).' Delete Command From Web App',$request->header('user-agent'));
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
        $record = Command::where('id', $request->id)->update($values);
        if ($record) {
            return endRequest('Success', 200, 'Status updated successfully.');
        } else {
            return endRequest('Error', 205, 'Something went wrong.');
        }
    }
}
