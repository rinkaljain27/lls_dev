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
                                                            <input type="text"  value="{{ Request::get('name') ?? old('name',isset($user) ? $user->name : '') ?? '' }}" name="name" class="form-control col-md-4" id="name" placeholder="UserName" >
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
                                                            <input type="text"  value="{{ Request::get('email') ?? old('email',isset($user) ? $user->email : '') ?? '' }}" name="email" class="form-control col-md-4" id="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Password</label>
                                                            <input type="password" placeholder="Password" class="form-control col-md-4" name="password" id="password" maxlength="25" value="{{ Request::get('password') ?? old('password','') ?? '' }}" autocomplete="new-password">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Confirm Password</label>
                                                            <input type="password" placeholder="Confirm Password" class="form-control col-md-4" name="c_password" id="c_password" maxlength="25" value="{{ Request::get('password') ?? old('password','') ?? '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Mobile No.</label>
                                                            <input type="text" name="mobile"  value="{{ Request::get('mobile') ?? old('mobile',isset($user) ? $user->mobile : '') ?? '' }}"  class="form-control col-md-4" id="mobile" placeholder="Mobile No." maxlength="10">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Address</label>
                                                            <textarea type="text"  name="address" class="form-control col-md-4" id="" placeholder="Address">{{ Request::get('address') ?? old('address',isset($user) ? $user->address : '') ?? '' }}</textarea>
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
                                    remote: {
                                        url: "{{ url('users/validateRecord') }}",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "post",
                                        data: {
                                            name : function () {
                                                return $("#users-form #name").val();
                                            }, id: function () {
                                                return $("#users-form #id").val();
                                            }
                                        }
                                    }
                                }, 
                                full_name: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                },
                                email: {
                                    required: true,
                                    email: true,
                                    minlength: 6,
                                    maxlength: 25,
                                    remote: {
                                        url: "{{ url('users/validateRecord') }}",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "post",
                                        data: {
                                            email : function () {
                                                return $("#users-form #email").val();
                                            }, id: function () {
                                                return $("#users-form #id").val();
                                            }
                                        }
                                    }
                                },
                                password: {
                                    required: true,
                                    minlength: 6,
                                    maxlength: 50,
                                },
                                c_password: {
                                    required: true,
                                    minlength: 6,
                                    maxlength: 50,
                                    equalTo: '[name="password"]',
                                },
                                mobile: {
                                    required: true,
                                    minlength: 10,
                                    maxlength: 10,
                                }
                            },
                            messages: {
                                role_id: {
                                    required: "Please Select Role",
                                },
                                name: {
                                    required: "Please Enter User Name",
                                    minlength: "UserName Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter User Name No More Than 20 Characters",
                                    remote: "User Name Already Exist.",
                                },
                                full_name: {
                                    required: "Please Enter Full Name",
                                    minlength: "Full Name Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Full Name No More Than 25 Characters"

                                },
                                email: {
                                    required: "Please Enter Email",
                                    email: "Please Enter A Valid Email Address",
                                    minlength: "Email Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Email No More Than 50 Characters",
                                    remote: "Email Already Exist.",
                                    
                                },
                                password: {
                                    required: "Please Enter Password",
                                    minlength: "Password Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Password No More Than 20 Characters"
                                },
                                c_password: {
                                    required: "Please Enter Confirm Password",
                                    minlength: "Password Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Password No More Than 20 Characters",
                                    equalTo: "The Password And Confirm Password Should Be Same."
                                },
                                mobile: {
                                    required: "Please Enter Mobile Number",
                                    minlength: "Mobile Number Must Be At Least 10 Digits Long",
                                    maxlength: "Please Enter Mobile Number No More Than 10 Digits",
                                }
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
                    $("#mobile").keydown(function (e) {
                        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                            return;
                        }
                        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 106)) {
                            e.preventDefault();
                        }
                    });
                </script>
@endsection
