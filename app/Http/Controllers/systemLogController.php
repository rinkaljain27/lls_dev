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
        $userName = User::select('id','name')->where('is_active',1)->get();
        $create = SystemLogs::select('id','type')->distinct()->get();
        return view('system_logs.list')->with('create', $create)->with('username', $userName);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  SYSTEM LOG LISTING PAGE
     * @date 2022-07-15
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = SystemLogs::with('userName')->whereNull('deleted_at')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('created_at', function($row){
                        $date = date('d/m/Y H:i:s', strtotime($row['created_at']));
                        return $date;
                    })
                    ->toJson();
        }
    }
   
}
