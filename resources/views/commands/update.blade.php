@extends('layouts.app')

@section('content')
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">Update Command</h4>
                                    <a href="{{url('commands')}}">
                                        <img src="<?php echo URL::to('assets\images\back-btn.svg'); ?>" width="30">
                                    </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="commands-form" action="{{ route('commands.store') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{isset($command) ? $command->id : ''}}" />
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Command Name</label>
                                                            <input type="text"  value="{{ Request::get('command_name') ?? old('command_name',isset($command) ? $command->command_name : '') ?? '' }}" name="command_name" class="form-control col-md-4" id="" placeholder="Command Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Command URL</label>
                                                            <input type="text"  value="{{ Request::get('command_url') ?? old('command_url',isset($command) ? $command->command_url : '') ?? '' }}" name="command_url" class="form-control col-md-4" id="" placeholder="Command URL">
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
                        $("#commands-form").validate({
                            rules: {
                                command_name: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                },
                                command_url: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                },
                            },
                            messages: {
                                command_name: {
                                    required: "Please Enter Command Name",
                                    minlength: "Role Name Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Role Name No More Than 20 Characters"
                                },
                                command_url: {
                                    required: "Please Enter Command URL",
                                    minlength: "Role Name Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Role Name No More Than 20 Characters"
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
