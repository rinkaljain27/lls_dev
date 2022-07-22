@extends('layouts.app')

@section('content')
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">Product Type List</h4>
                                        <?php if ($create) { ?>
                                        <a href="{{url('product_type/create')}}">
                                            <img src="<?php echo URL::to('assets\images\add-icon.svg'); ?>" width="30">
                                        </a> 
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table id="productTypeData" class="table table-hover table-bordered table-striped" cellspacing="0" width="100%" >
                                        <thead>
                                        <tr>
                                            <th> Product Type </th>
                                            <th> Status </th>
                                            <th> Created Date </th>
                                            <th> Updated Date </th>
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
                        var url = "{{ url('product_type/show') }}";
                        dataTableConfigObj.ajax.url = url;

                        var columns = [{
                                data: 'product_type',
                                name: 'product_type'
                            }, {
                                data: 'status',
                                name: 'status'
                            }, {
                                data: 'created_at',
                                name: 'created_at'
                            }, {
                                data: 'updated_at',
                                name: 'updated_at'
                            },{
                                data: 'action',
                                name: 'action',
                                orderable: false,
                            },
                        ];
                        
                        dataTableConfigObj.columns = columns;
                        // alert(columns);
                        $('#productTypeData').dataTable(dataTableConfigObj);
                        });
                        
                        function deleteConfirmation(id) {
                            swal({
                                title: "Delete?",
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
                                        url: "{{ url('product_type/destroy') }}",
                                        success: function (data) {
                                            if (data.responseCode == 200) {
                                                toastr.success(data.responseMessage, data.responseStatus);
                                                var oTable = $('#productTypeData').dataTable();
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
                                return false;
                            })
                        }
            </script>
@endsection
