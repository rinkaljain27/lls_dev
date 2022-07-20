@extends('layouts.app')

@section('content')
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">Role List</h4>
                                        <?php if ($create) { ?>
                                        <a href="{{url('roles/create')}}">
                                            <img src="<?php echo URL::to('assets\images\add-icon.svg'); ?>" width="30">
                                        </a> 
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table id="rolesdata" class="table table-hover table-bordered table-striped" cellspacing="0" width="100%" >
                                        <thead>
                                        <tr>
                                            <th> Role Name </th>
                                            <th> Created Date </th>
                                            <th> Action </th>
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
                    
                    <div class="row">
                    
                    </div>
                </div>
                <script type="text/javascript">
                   
                     $(function () {
                        var url = "{{ url('roles/show') }}";
                        dataTableConfigObj.ajax.url = url;

                        var columns = [{
                                data: 'name',
                                name: 'name'
                            }, {
                                data: 'created_at',
                                name: 'created_at'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                            },
                        ];
                        
                        dataTableConfigObj.columns = columns;
                        // alert(columns);

                        $('#rolesdata').dataTable(dataTableConfigObj);
                        });
                        
                        function deleteConfirmation(id) {
                            swal({
                                title: "Are you Sure Want to Delete this Record?",
                                text: "Please ensure and then confirm!",
                                type: "warning",
                                showCancelButton: !0,
                                confirmButtonText: "Yes, delete it!",
                                cancelButtonText: "No, cancel!",
                                reverseButtons: !0
                            }).then(function (e) {
                                if (e === true) {
                                    var token = $('meta[name="csrf-token"]').attr('content');
                                    $.ajax({
                                        type: "POST",
                                        data: {
                                            "id": id,
                                            "_method": "DELETE",
                                            "_token": token,
                                        },
                                        dataType: 'JSON',
                                        url: "{{ url('roles/destroy') }}",
                                        success: function (data) {
                                            if (data.responseCode == 200) {
                                                toastr.success(data.responseMessage, data.responseStatus);
                                                var oTable = $('#rolesdata').dataTable();
                                                oTable.fnDraw(false);
                                            } else {
                                                toastr.error(data.responseMessage, data.responseStatus);
                                            }
                                        },
                                        error: function (data) {
            //                                console.log('Error:', data);
                                        }
                                    });
                                } else {
                                    e.dismiss;
                                }
                            }, function (dismiss) {
                                toastr.success('Record is Safe', 'Success');
                                return false;
                            })
                        }
            </script>
@endsection