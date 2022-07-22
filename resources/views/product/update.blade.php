@extends('layouts.app')

@section('content')
<!-- partial -->
                <div class="content-wrapper">                 
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-header card-head-bg">
                                    <div class="box-tools">
                                    <h4 class="card-title">Update Product</h4>
                                    <a href="{{url('product')}}" >
                                        <img src="<?php echo URL::to('assets\images\back-btn.svg'); ?>" width="30">
                                    </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="product-form" action="{{ route('product.store') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{isset($product) ? $product->id : ''}}" />
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label">Product Name</label>
                                                            <input type="text"  value="{{ Request::get('product_name') ?? old('product_name',isset($product) ? $product->product_name : '') ?? '' }}" name="product_name" class="form-control col-md-4" id="exampleInputName1" placeholder="Product Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Product Type</label>
                                                                <select class="form-control select2 js-example-basic-single" id="product_type_id" name= "product_type_id"  style="width:100%" >
                                                                <option value="">Select One</option>
                                                                    @foreach($productType as $productTypes)
                                                                    <option {{ (isset($product) && $product->product_type_id == $productTypes->id) ? 'selected' : '' }} value="{{ $productTypes->id }}">{{ $productTypes->product_type }}</option>
                                                                    @endforeach
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
                        $("#product-form").validate({
                            rules: {
                                product_name: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 20,
                                },
                                product_type_id: {
                                    required: true,
                                },
                            },
                            messages: {
                                product_name: {
                                    required: "Please Enter Product Name",
                                    minlength: "Product Name Must Be At Least 6 Characters Long",
                                    maxlength: "Please Enter Product Name No More Than 20 Characters"
                                },
                                product_type_id: {
                                    required: "Please Select Product Type",
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
