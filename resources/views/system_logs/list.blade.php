@extends('layouts.app')

@section('content')
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">System Logs</h4>
                                        <?php if ($create) { ?>
                                        <a href="{{url('system_logs/create')}}" >
                                            <img src="<?php echo URL::to('assets\images\add-icon.svg'); ?>" width="30">
                                        </a> 
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                        <div class="col-md-2 col-md-2">
                                            <div class="form-group">
                                                    <select class="form-control select2 js-example-basic-single" id="product_type_id" name= "product_type_id"  style="width:100%" >
                                                    <option value="">Select One</option>
                                                        @foreach($username as $userNames)
                                                            <option value="{{ $userNames->id }}">{{ $userNames->name }}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-md-2">
                                            <div class="form-group">
                                                    <select class="form-control select2 js-example-basic-single"  name= ""  style="width:100%" >
                                                    <option value="">Select One</option>
                                                        @foreach($create as $creates)
                                                            <option value="{{ $creates->id }}">{{ $creates->type }}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                                </div>
                                                <input type="text" class="form-control frm-con-bg daterange" name="datetimes" id="daterange" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-1 set-two-btn">
                                            <button type="button" class="btn btn-block btn-warning search-btn get-records" >
                                                <i class="fa fa-play loader-class"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                    <table id="systemLogsData" class="table table-hover table-bordered table-striped" cellspacing="0" width="100%" >
                                        <thead>
                                        <tr>
                                            <th> User Name </th>
                                            <th> Type </th>
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
                   
                     $(function () {
                        var url = "{{ url('system_logs/show') }}";
                        dataTableConfigObj.ajax.url = url;

                        var columns = [{
                                data: 'user_name.name',
                                name: 'user_name'
                            },{
                                data: 'type',
                                name: 'type'
                            }, {
                                data: 'comment',
                                name: 'comment'
                            }, {
                                data: 'created_at',
                                name: 'created_at'
                            },
                        ];
                        
                        dataTableConfigObj.columns = columns;
                        // alert(columns);
                        $('#systemLogsData').dataTable(dataTableConfigObj);
                        });
                        
            </script>
@endsection
