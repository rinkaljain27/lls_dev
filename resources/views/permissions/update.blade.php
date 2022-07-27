@extends('layouts.app')

@section('content')
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">Update Permission</h4>
                                    <a href="{{url('permissions')}}">
                                        <img src="<?php echo URL::to('assets\images\back-btn.svg'); ?>" width="30">
                                    </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="permissions-form" action="{{ route('permissions.store') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{isset($permission) ? $permission->id : ''}}" />
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Permission Name</label>
                                                            <input type="text"  value="{{ Request::get('permission_name') ?? old('permission_name',isset($permission) ? $permission->permission_name : '') ?? '' }}" name="permission_name" class="form-control col-md-4" id="" placeholder="Permission Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Permission Slug</label>
                                                            <input type="text"  value="{{ Request::get('permission_slug') ?? old('permission_slug',isset($permission) ? $permission->permission_slug : '') ?? '' }}" name="permission_slug" class="form-control col-md-4" id="" placeholder="Permission Slug">
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    var container = $('#errors');
                    function updateErrorContainer(errorId, errorMsg) {
                        if (typeof errorMsg != 'undefined' && errorMsg != '') {
                            $("#" + errorId).removeClass("hidden").find("label").html(errorMsg);
                            container.removeClass("hidden");
                        }
                    }
                    $(document).ready(function($) {
                        $("#permissions-form").validate({
                            rules: {
                                permission_name: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                },
                                permission_slug: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                },
                            },
                            messages: {
                                permission_name: {
                                    required: "Please Enter Permission Name",
                                    minlength: "Permission Name Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Permission Name No More Than 20 Characters"
                                },
                                permission_slug: {
                                    required: "Please Enter Permission Slug",
                                    minlength: "Permission Slug Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Permission Slug No More Than 20 Characters"
                                },
                            },
                            errorPlacement: function(error, element) {
                                if (element.is(":radio")) {
                                    error.appendTo(element.parents('.form-group'));
                                } else { // This is the default behavior 
                                    error.insertAfter(element);
                                }
                            },
                            submitHandler: function(form) {
                                form.submit();
                            }

                        });
                    });
                </script>
@endsection
