@extends('layouts.app') @section('content')
<!-- partial -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header card-head-bg">
                    <div class="box-tools">
                        <h4 class="card-title">Role List</h4>
                        <?php if ($create) { ?>
                        <a href="{{ url('roles/create') }}">
                            <img
                                src="<?php echo URL::to('assets\images\add-icon.svg'); ?>"
                                width="30"
                            />
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            id="rolesdata"
                            class="table table-hover table-bordered table-striped"
                            cellspacing="0"
                            width="100%"
                        >
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div
    aria-hidden="false"
    role="dialog"
    tabindex="-1"
    id="status-modal"
    class="modal fade in"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="del-flg" />
            <div class="modal-header modal_header_bg email-modal-header">
                <h5 class="modal-title email-modal-title" id="modal-title">
                    Confirmation
                </h5>
                <button
                    type="button"
                    class="close email-modal-close-btn"
                    data-dismiss="modal"
                    aria-label="Close"
                    id="btn-close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="error-text">
                    <i class="icon-warning-sign modal-icon"></i
                    ><span id="status-msg"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button
                    onclick="javascript:UpdateStatus($('#hdnDeleteId').val(), $('#status-flg').val());"
                    data-dismiss="modal"
                    class="btn btn-warning"
                >
                    Update
                </button>
                <button
                    aria-hidden="true"
                    data-dismiss="modal"
                    class="btn btn-danger"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <input type="hidden" value="" id="hdnDeleteId" name="hdnDeleteId" />
    <input type="hidden" value="" id="status-flg" name="status-flg" />
</div>
<script type="text/javascript">
    $(function () {
        var url = "{{ url('roles/show') }}";
        dataTableConfigObj.ajax.url = url;

        var columns = [
            {
                data: "name",
                name: "name",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
            },
        ];

        dataTableConfigObj.columns = columns;
        // alert(columns);

        $("#rolesdata").dataTable(dataTableConfigObj);
    });

    function deleteConfirmation(id) {
        swal({
            title: "Delete?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0,
        }).then(
            function (e) {
                if (e === true) {
                    var token = $('meta[name="csrf-token"]').attr("content");
                    $.ajax({
                        type: "POST",
                        data: {
                            id: id,
                            _method: "DELETE",
                            _token: token,
                        },
                        dataType: "JSON",
                        url: "{{ url('roles/destroy') }}",
                        success: function (data) {
                            if (data.responseCode == 200) {
                                toastr.success(
                                    data.responseMessage,
                                    data.responseStatus
                                );
                                var oTable = $("#rolesdata").dataTable();
                                oTable.fnDraw(false);
                            } else {
                                toastr.error(
                                    data.responseMessage,
                                    data.responseStatus
                                );
                            }
                        },
                        error: function (data) {
                            //                                console.log('Error:', data);
                        },
                    });
                } else {
                    e.dismiss;
                }
            },
            function (dismiss) {
                return false;
            }
        );
    }
    function setStatusModel(id, flg) {
        $("#status-flg").val(flg);
        $("#status-msg").html(
            "Are you sure want to change status of this record?"
        );
        $("#hdnDeleteId").val(id);
    }
    function UpdateStatus(id, val) {
        $.post(
            "{{ url('roles/updateStatus') }}",
            {
                _token: "{{ csrf_token() }}",
                id: id,
                val: val,
            },
            function (data) {
                if (data.responseCode == 200) {
                    toastr.success(data.responseMessage, data.responseStatus);
                    $("#status-modal").modal("hide");
                    var oTable = $(".dataTable").dataTable();
                    oTable.fnDraw(false);
                } else {
                    toastr.error(data.responseMessage, data.responseStatus);
                }
            },
            "json"
        );
    }
</script>
@endsection
