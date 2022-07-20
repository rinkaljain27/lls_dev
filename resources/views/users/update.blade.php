@extends('layouts.app')

@section('content')
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">Update User</h4>
                                    <a href="{{url('users')}}" >
                                        <img src="<?php echo URL::to('assets\images\back-btn.svg'); ?>" width="30" >
                                    </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="users-form" action="{{ route('users.store') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{isset($user) ? $user->id : ''}}" />
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select class="form-control select2 js-example-basic-single" id="role_id" name= "role_id"  style="width:100%">
                                                                <option value="">Select Role</option>
                                                                @foreach($role as $roles)
                                                                <option {{ (isset($user) && $user->role_id == $roles->id) ? 'selected' : '' }} value="{{ $roles->id }}">{{ $roles->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">UserName</label>
                                                            <input type="text"  value="{{ Request::get('name') ?? old('name',isset($user) ? $user->name : '') ?? '' }}" name="name" class="form-control col-md-4" id="" placeholder="UserName">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Full Name</label>
                                                            <input type="text"  value="{{ Request::get('full_name') ?? old('full_name',isset($user) ? $user->full_name : '') ?? '' }}" name="full_name" class="form-control col-md-4" id="" placeholder="Full Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Email</label>
                                                            <input type="text"  value="{{ Request::get('email') ?? old('email',isset($user) ? $user->email : '') ?? '' }}" name="email" class="form-control col-md-4" id="" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Password</label>
                                                            <input type="password" placeholder="Password" class="form-control col-md-4" name="password" id="password" maxlength="25" value="{{ Request::get('password') ?? old('password','') ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Mobile No.</label>
                                                            <input type="number" name="mobile"  value="{{ Request::get('mobile') ?? old('mobile',isset($user) ? $user->mobile : '') ?? '' }}"  class="form-control col-md-4" id="" placeholder="Mobile No.">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Address</label>
                                                            <textarea type="text" name="address" class="form-control col-md-4" id="" placeholder="Address">{{ Request::get('address') ?? old('address',isset($user) ? $user->address : '') ?? '' }}</textarea>
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
                        $("#users-form").validate({
                            rules: {
                                role_id: {
                                    required: true,
                                },
                                name: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                }, 
                                full_name: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                },
                                email: {
                                    required: true,
                                    email: true
                                },
                                password: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 25,
                                },
                                mobile: {
                                    required: true,
                                    minlength: 10,
                                    maxlength: 12,
                                },
                                address: {
                                    required: true,
                                },
                            },
                            messages: {
                                role_id: {
                                    required: "Please Select your Role",
                                },
                                name: {
                                    required: "Please enter your UserName",
                                    minlength: "Your UserName must be at least 6 characters long",
                                    maxlength: "Please enter UserName no more than 20 characters"

                                },
                                full_name: {
                                    required: "Please enter your Full Name",
                                    minlength: "Your Full Name must be at least 6 characters long",
                                    maxlength: "Please enter Full Name no more than 20 characters"

                                },
                                email: {
                                    required: "Please enter your Email",
                                    email: "Please Enter A Valid Email Address"
                                },
                                password: {
                                    required: "Please enter your Password",
                                    minlength: "Your Password must be at least 6 characters long",
                                    maxlength: "Please enter Password no more than 20 characters"
                                },
                                mobile: {
                                    required: "Please enter your Mobile Number",
                                    minlength: "Your Mobile Number must be at least 10 digits long",
                                    maxlength: "Please enter Mobile Number no more than 12 characters"

                                },
                                address: {
                                    required: "Please enter your Address",
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
