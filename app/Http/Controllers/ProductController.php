<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\ProductType; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Product INDEX PAGE
     * @date 2022-07-15
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $create = Product::all();
        return view('product.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Product Listing PAGE
     * @date 2022-07-15
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = Product::with('productType')->where('is_active',1)->whereNull('deleted_at')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return getBtnHtml($row, 'product', true, true);
                    })
                    ->addColumn('created_at', function($row){
                        $date = date('Y/m/d H:i:s', strtotime($row['created_at']));
                        return $date;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Product create PAGE
     * @date 2022-07-15
     */
    public function create(Request $request) {
        $productType = ProductType::all();
        return view('product.update')->with('productType',$productType);
    }
    /*
    * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Product INSERT RECORDS
     * @date 2022-07-15
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'product_name' => 'required|alpha|min:2|max:20|unique:product,product_name,' . $request->id . ',id,deleted_at,NULL',
            'product_type_id' => 'required',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $product = Product::find($request->id);
            insertSystemLog('Update Product From Web',auth()->user()->name,$request->header('user-agent'));
        } else {
            $product = new Product();
            insertSystemLog('Insert Product From Web',auth()->user()->name,$request->header('user-agent'));
        }
        $product->product_name = $request->product_name;
        $product->product_type_id = $request->product_type_id;
        $product->save();
        if($product){
            Toastr::success('Product updated successfully.', 'Success');
            return Redirect::route('product.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Product edit PAGE
     * @date 2022-07-15
     */
    public function edit(Request $request, Product $product) {
        $productType = ProductType::all();
        return view('product.update')
                        ->with('product', $product)
                        ->with('productType', $productType);
    }
     /*
     * @category WEBSITE
     * @author Original Author Rinkal Jain
     * @author Another Author <rjain@moba.de>
     * @copyright MOBA
     * @comment  Product delete Records
     * @date 2022-07-15
     */
    public function destroy(Request $request) {
        $record = Product::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete Product From Web',auth()->user()->name,$request->header('user-agent'));
                return endRequest('Success', 200, 'Record deleted successfully.');
            } else {
                return endRequest('Error', 205, 'Record not found.');
            }
    }
}
