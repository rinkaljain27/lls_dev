<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemLogs; 
use App\Models\User; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class systemLogController extends Controller
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
     * @comment  SYSTEM LOG INDEX PAGE
     * @date 2022-07-28
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        checkPermissions('system-log-view');
        $userName = User::select('id','name')->where('is_active',1)->get();
        $user_id = Session::get('user.id');
        $create = SystemLogs::distinct()->get(['type']);
        return view('system_logs.list')->with('create', $create)->with('username', $userName)->with('userId',$user_id);
    }

    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  GET SYSTEM LOGS FILTER
     * @date 2022-08-01
     */

    public function getSystemLogs(Request $request) {
        checkPermissions('system-log-view');
        $sdate = $request->sdate;
        $edate = $request->edate;
        $type = $request->type;
        $username = $request->username;
        
        $query = DB::table('system_logs as sl');
        $query->select('sl.created_at', 'sl.type', 'sl.comment', 'sl.user_id', 'us.name');
        $query->leftJoin('users as us', 'us.id', '=', 'sl.user_id');
        $query->whereBetween('sl.created_at', [$sdate, $edate]);

        if ($type != "all") {
            $query->where('sl.type', '=', $type);
        }
        if ($username != "all") {
            $query->where('sl.user_id', '=', $username);
        }
        
        $log_data = $query->get();
        // printData($trackdata);
        $total_logs = array();

            foreach ($log_data as $row) {
            $row->name = ucwords($row->name);
           
            if ($row->created_at != '') {
                $row->created_at = date('d/m/Y H:i A', strtotime($row->created_at));
            }
            array_push($total_logs, $row);
        }
        $data['aaData'] = $total_logs;
        $data['iTotalDisplayRecords'] = $data['iTotalRecords'] = count($total_logs);

        echo json_encode($data);
        exit;

    }
   
}
