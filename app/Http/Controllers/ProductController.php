<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\ProductType; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT INDEX PAGE
     * @date 2022-07-15
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        checkPermissions('product-view');
        $create = checkPermissions('product-create', true);
        return view('product.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT LISTING PAGE
     * @date 2022-07-15
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = Product::with('productType')->whereNull('deleted_at')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $user = Auth::user();
                        return getBtnHtml($row, 'product', $user->hasRole('admin'), checkPermissions('product-edit', true), checkPermissions('product-delete', true));
                    })
                    ->addColumn('status', function ($row) {
                        return formatStatusColumn($row);
                    })
                    ->addColumn('created_at', function($row){
                        $date = date('d/m/Y H:i:s', strtotime($row['created_at']));
                        return $date;
                    })
                    ->rawColumns(['status','action'])
                    ->toJson();
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT CREATE PAGE
     * @date 2022-07-15
     */
    public function create(Request $request) {
        checkPermissions('product-create');
        $productType = ProductType::all();
        return view('product.update')->with('productType',$productType);
    }
    /*
    * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT INSERT RECORDS
     * @date 2022-07-15
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'product_name' => 'required|min:2|max:20|unique:product,product_name,' . $request->id . ',id,deleted_at,NULL',
            'product_type_id' => 'required',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $product = Product::find($request->id);
            insertSystemLog('Update Product',ucfirst(auth()->user()->name).' Update Product From Web App',$request->header('user-agent'));
        } else {
            $product = new Product();
            $product->created_at = date('Y-m-d H:i:s');
            $product->updated_at = date('Y-m-d H:i:s');
            insertSystemLog('Insert Product',ucfirst(auth()->user()->name).' Insert Product From Web App',$request->header('user-agent'));
        }
        $product->product_name = $request->product_name;
        $product->product_type_id = $request->product_type_id;
        $product->save();
        if($product){
            Toastr::success('Product Updated Successfully.', 'Success');
            return Redirect::route('product.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT EDIT PAGE
     * @date 2022-07-15
     */
    public function edit(Request $request, Product $product) {
        checkPermissions('product-edit');
        $productType = ProductType::all();
        return view('product.update')
                        ->with('product', $product)
                        ->with('productType', $productType);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT DELETE RECORDS
     * @date 2022-07-15
     */
    public function destroy(Request $request) {
        checkPermissions('product-delete');
        $record = Product::where('id', $request->id)->update(['is_active' => 0 , 'deleted_at' => date('Y-m-d H:i:s')]);
        // $record = Product::destroy($request->id);
        if ($record) {
                insertSystemLog('Delete Product',ucfirst(auth()->user()->name).' Delete Product From Web App',$request->header('user-agent'));
                return endRequest('Success', 200, 'Record Deleted Successfully.');
            } else {
                return endRequest('Error', 205, 'Record Not Found.');
            }
    }
    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  CHANGE STATUS FUNCTION
     * @date 2022-07-25
     */
    public function updateStatus(Request $request) {
        $values = array(
            'is_active' => $request->val,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $record = Product::where('id', $request->id)->update($values);
        if ($record) {
            return endRequest('Success', 200, 'Status updated successfully.');
        } else {
            return endRequest('Error', 205, 'Something went wrong.');
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  RECORD VALIDATE
     * @date 2022-08-08
     */
    public function validateRecord(Request $request)
    {
        $id = $request->id;
        $product_name = $request->product_name;
        
        if ($product_name) {
            $query = DB::table('product');
            if($product_name){
                $query->where('product_name',$product_name)->where('id','!=',$id);
            }
            $user = $query->first();
            if($user){
                echo json_encode(FALSE);
                exit;
            }else{
                echo json_encode(TRUE);
                exit; 
            }
        } else {
            echo json_encode(FALSE);
            exit;
        }
    }
}
