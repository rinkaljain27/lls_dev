@extends('layouts.app') @section('content')
<!-- partial -->
<div class="content-wrapper">
    
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header card-head-bg">
                    <div class="box-tools">
                        <span class="card-title card-icon"><i class="fa fa-filter"></i>
                        </span>
                        <button class="btn btn-tool collapsed" style="padding:0px;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                            <i class="fa fa-minus"></i>
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="collapse show" id="collapseExample">
                    <div class="card-body filter">
                        <div class="row">
                            @if($userId != 1)
                            <div class="col-md-3" style="display: none;">
                                <div class="form-group">
                                        <select class="form-control select2 js-example-basic-single" id="username" name= "username"  style="width:100%" >
                                        <option value="all">All Users</option>
                                            @foreach($username as $userNames)
                                            @if($userId != 1)
                                            <option {{ (isset($userId) && $userId == $userNames->id) ? 'selected' : '' }} value="{{ $userNames->id }}">{{ ucfirst($userNames->name) }} </option>
                                            @else
                                                <option value="{{ $userNames->id }}">{{ ucfirst($userNames->name) }} </option>
                                            @endif
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            @else
                            <div class="col-md-3">
                                <div class="form-group">
                                        <select class="form-control select2 js-example-basic-single" id="username" name= "username"  style="width:100%" >
                                        <option value="all">All Users</option>
                                            @foreach($username as $userNames)
                                            @if($userId != 1)
                                            <option {{ (isset($userId) && $userId == $userNames->id) ? 'selected' : '' }} value="{{ $userNames->id }}">{{ ucfirst($userNames->name) }} </option>
                                            @else
                                                <option value="{{ $userNames->id }}">{{ ucfirst($userNames->name) }} </option>
                                            @endif
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-3">
                                <div class="form-group">
                                        <select class="form-control select2 js-example-basic-single"  name= "type" id="type"  style="width:100%" >
                                        <option value="all">All Type</option>
                                            @foreach($create as $creates)
                                                <option value="{{ $creates->type }}">{{ $creates->type }}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control frm-con-bg daterange" name="datetimes" id="daterange" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-1 set-two-btn">
                                <button type="submit" class="btn btn-block btn-warning search-btn get-records" onclick="reloadTable()">
                                    <i class="fa fa-play loader-class"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header card-head-bg">
                    <div class="box-tools">
                    <h4 class="card-title">System Log List</h4>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="systemLogsData" class="table table-hover table-bordered table-striped" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th> User Name </th>
                                <th> User Type </th>
                                <th> Comment </th>
                                <th> Created Date </th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('#daterange').daterangepicker({
            timePicker: true,
                            timePicker24Hour: false,
                            timePickerIncrement: 1,
                            locale: {
                                format: 'DD/MM/YYYY HH:mm A'
                            }
        }, function (start, end, label) {

        });

        $(document).on('focus', ':input', function () {
            $(this).attr('autocomplete', 'off');
        });

        var url = createAjaxURL();

        dataTableConfigObj.ajax = {
            "url": url
        };
            
        var columns = [
            {"data": "name"},
            {"data": "type"},
            {"data": "comment"},
            {"data": "created_at"},

        ];
        dataTableConfigObj.columns = columns;
        dataTableConfigObj.order = [1, 'asc'];
        dataTableConfigObj.bServerSide = false;
        dataTableConfigObj.autoWidth = true;
        dataTableConfigObj.scrollX = true;
        dataTableConfigObj.bDestroy = true;

        oTable = $('#systemLogsData').dataTable(dataTableConfigObj);

        });

    function reloadTable() {
        var url = createAjaxURL();
        var oTable1 = $('#systemLogsData').DataTable();
        oTable1.ajax.url(url).load();
    }
    function createAjaxURL() {
        var token = "{{csrf_token()}}";
        var username = $('#username').val();
        var type = $('#type').val();
        var sdate = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
        var edate = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
        var url = "/system_logs/getSystemLogs?_token=" + token + "&type=" + type + "&username=" + username + "&sdate=" + sdate + "&edate=" + edate;
        return url;
    }

</script>
@endsection
