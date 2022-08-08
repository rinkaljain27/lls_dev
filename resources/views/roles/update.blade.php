@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="<?php echo URL::to('assets\css\fSelect.css'); ?>" />
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">Update Role</h4>
                                    <a href="{{url('roles')}}">
                                        <img src="<?php echo URL::to('assets\images\back-btn.svg'); ?>" width="30">
                                    </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="roles-form" action="{{ route('roles.store') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{isset($role) ? $role->id : ''}}" />
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Name</label>
                                                            <input type="text"  value="{{ Request::get('name') ?? old('name',isset($role) ? $role->name : '') ?? '' }}" name="name" class="form-control col-md-4" id="name" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Command</label>
                                                            <select class="search_drop form-control" multiple="multiple" name="commands[]">
                                                                <option class="allcheck" value="all">Select All</option>
                                                                <?php
                                                                foreach ($command as $key => $value) {
                                                                    $selected = '';
                                                                    if (isset($role) && in_array($value['id'], $role_command)) {
                                                                        $selected = 'selected';
                                                                    }
                                                                    echo "<option " . $selected . " class='checkbox' value='" . $value['id'] . "'>" . $value['command_name'] ."</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Permission</label>
                                                            <select class="search_drop form-control" multiple="multiple" name="permissions[]">
                                                                <option class="allcheck" value="all">Select All</option>
                                                                <?php
                                                                foreach ($permission as $key => $value) {
                                                                    $selected = '';
                                                                    if (isset($role) && in_array($value['id'], $role_permission)) {
                                                                        $selected = 'selected';
                                                                    }
                                                                    echo "<option " . $selected . " class='checkbox' value='" . $value['id'] . "'>" . $value['permission_name'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
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
                        $("#roles-form").validate({
                            rules: {
                                name: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                    remote: {
                                        url: "{{ url('roles/validateRecord') }}",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "post",
                                        data: {
                                            name : function () {
                                                return $("#roles-form #name").val();
                                            }, id: function () {
                                                return $("#roles-form #id").val();
                                            }
                                        }
                                    }
                                },
                                commands: {
                                    required: true,
                                },
                                permissions: {
                                    required: true,
                                },
                            },
                            messages: {
                                name: {
                                    required: "Please Enter Role Name",
                                    minlength: "Role Name Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Role Name No More Than 20 Characters",
                                    remote: "Role Name Already Exist.",
                                },
                                commands: {
                                    required: "Please Select Commands",
                                },
                                permissions: {
                                    required: "Please Select permissions",
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
                <script src="<?php echo URL::to('assets\js\fSelect.js'); ?>" crossorigin="anonymous"></script> 
   
                <script>
                    $('.search_drop').fSelect();

                    $('.allcheck').click(function () {
                        if (!$('.allcheck').is(":checked")) {
                            $('.checkbox').addClass('selected');
                        } else {
                            $('.checkbox').removeClass('selected');
                        }
                    });

                </script>
@endsection
