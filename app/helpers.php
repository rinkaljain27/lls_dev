<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\SystemLogs;
use App\Models\ApiLogs;
use Illuminate\Support\Facades\Validator;

/* PRINT DATA */
function printData($data, $break = true) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($break) {
        die;
    }
}

/* Store Log Activity */
function insertSystemLog($type, $comment, $json_data) {
    $log['type'] = $type;
    $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
    $log['comment'] = $comment;
    $log['json_data'] = $json_data;
    $log['show_case'] = 'internal';
    // dd($log);
    $activityLog = new SystemLogs($log);
    $activityLog->save();
}

/* Store Api Log Activity */
function insertApiLog($api_type, $api_name, $request_data, $response_data) {
    $log['api_type'] = $api_type;
    $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
    $log['api_name'] = $api_name;
    $log['request_data'] = $request_data;
    $log['response_data'] = $response_data;
    // dd($response_data);
    // dd($log);
    $activityLog = new ApiLogs($log);
    $activityLog->save();
}

// send Response
function endRequest($status, $responseCode, $responseMessage, $data = '') {
    $response = array();

    $response['responseStatus'] = $status;
    $response['responseCode'] = $responseCode;
    $response['responseMessage'] = $responseMessage;
    if ($status == true && $data) {
        $response['data'] = $data;
    }
    return response()->json($response);
}
// crud buttons
function getBtnHtml($row, $module, $is_admin, $editBtn, $deleteBtn) {
    $actionBtn = '';
    if ($module == 'user') {
        $id = $row->userid;
    } else {
        $id = $row['id'];
    }
    if ($is_admin || $editBtn) {
        $actionBtn .= '<a href="' . $module . '/' .$id.'/edit" class="edit btn btn-success btn-sm ">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>&nbsp;';
    }
    if ($is_admin || $deleteBtn) {
        $actionBtn .= '<a href="javascript:void(0);
        " id="delete-product" onclick="deleteConfirmation(' .$id.')" class="delete btn btn-danger btn-sm ">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>&nbsp;';
    }

    return $actionBtn;
}

function ValidateFromInput($input,$validate){
    $validator = Validator::make($input,$validate);
    if ($validator->fails()) {
        $message = $validator->errors()->first();
        return $message;
    }
}
function formatStatusColumn($row) {
    $returnVal = '';
    if ($row['is_active'] == 0) {
        $returnVal .= "<a data-target='#status-modal' title='Change Status' onclick='javascript:setStatusModel(" . $row['id'] . "," . 1 . ")' data-toggle='modal' class='btn-warning btn-sm cursor-pointer'>Inactive</a>&nbsp;";
    } else {
        $returnVal .= "<a data-target='#status-modal' title='Change Status' onclick='javascript:setStatusModel(" . $row['id'] . "," . 0 . ")' data-toggle='modal' class='btn-success btn-sm cursor-pointer'>Active</a>&nbsp;";
    }
    return $returnVal;
}
function removeArrayElement($data) {
    if ($data) {
        if (($key = array_search("all", $data)) !== false) {
            unset($data[$key]);
        }
    }
    return $data;
}
function checkPermissions($url_slug, $btn = false) {
    $permissions = Session::get('permissions');
    if ($btn) {
        if (!in_array($url_slug, $permissions)) {
            return false;
        }
        return true;
    } else {
        if (!in_array($url_slug, $permissions)) {
            return abort(404);
        }
    }
}

function getLastSQL($break = true) {
    $queries = DB::getQueryLog();
    $last_query = 'No query found.';
    if ($queries) {
        $last_query = end($queries);
        $last_query = bindDataToQuery($last_query);
    }
    echo $last_query;
    if ($break) {
        die;
    }
}

function bindDataToQuery($queryItem) {
    $query = $queryItem['query'];
    $bindings = $queryItem['bindings'];
    $arr = explode('?', $query);
    $res = '';
    foreach ($arr as $idx => $ele) {
        if ($idx < count($arr) - 1) {
            $res = $res . $ele . "'" . $bindings[$idx] . "'";
        }
    }
    $res = $res . $arr[count($arr) - 1];
    return $res;
}
