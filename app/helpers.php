<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\SystemLogs;
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
    $activityLog = new SystemLogs($log);
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
function getBtnHtml($row, $module, $editBtn, $deleteBtn) {
    $actionBtn = '';
    if ($module == 'user') {
        $id = $row->userid;
    } else {
        $id = $row['id'];
    }
    if ($editBtn) {
        $actionBtn .= '<a href="' . $module . '/' .$id.'/edit" class="edit btn btn-success btn-sm ">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>&nbsp;';
    }
    if ($deleteBtn) {
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

