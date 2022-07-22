<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr; 
use DataTables;

class ProductTypeController extends Controller
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
     * @comment  PRODUCT TYPE INDEX PAGE
     * @date 2022-07-13
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $create = ProductType::all();
        return view('product_type.list')->with('create', $create);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT TYPE LISTING PAGE
     * @date 2022-07-13
     */

    public function show(Request $request) {
        if ($request->ajax()) {
            $data = ProductType::all()->toarray();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return getBtnHtml($row, 'product_type', true, true);
                    })
                    ->addColumn('status', function($row){
                        if($row['is_active'] == 1) {
                            return 'Active';
                        }
                    })
                    ->addColumn('created_at', function($row){
                        $date = date('d/m/Y H:i:s', strtotime($row['created_at']));
                        return $date;
                    })
                    ->addColumn('updated_at', function($row){
                        $date = date('d/m/Y H:i:s', strtotime($row['updated_at']));
                        return $date;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
        }
    }
    /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT TYPE CREATE PAGE
     * @date 2022-07-13
     */
    public function create(Request $request) {
        return view('product_type.update');
    }
    /*
    * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT TYPE INSERT RECORDS
     * @date 2022-07-13
     */
    public function store(Request $request) {
        // printData($request->all());
        $input = $request->all();
        $validate = [
            'product_type' => 'required|min:2|max:20|unique:product_type,product_type,' . $request->id . ',id,deleted_at,NULL',
        ];
        $message = ValidateFromInput($input,$validate);
        if($message){
            Toastr::error($message, 'Error');
            return Redirect::back();
        }
        if ($request->id) {
            $product_type = ProductType::find($request->id);
            insertSystemLog('Update Product Type From Web App',ucfirst(auth()->user()->name).' Update Product Type From Web App',$request->header('user-agent'));
        } else {
            $product_type = new ProductType();
            $product_type->created_at = date('Y-m-d H:i:s');
            $product_type->updated_at = date('Y-m-d H:i:s');
            insertSystemLog('Insert Product Type From Web App',ucfirst(auth()->user()->name).' Insert Product Type From Web App',$request->header('user-agent'));
        }
        $product_type->product_type = $request->product_type;
        $product_type->save();
        if($product_type){
            Toastr::success('Product Type Updated Successfully.', 'Success');
            return Redirect::route('product_type.index');
        }
        Toastr::success('Something Wrong', 'Error');
        return Redirect::back();
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT TYPE EDIT PAGE
     * @date 2022-07-13
     */
    public function edit(Request $request, ProductType $product_type) {
        return view('product_type.update')
                        ->with('product_type', $product_type);
    }
     /*
     * @category WEBSITE
     * @author Original Author <rjain@moba.de>
     * @author Another Author <ksanghavi@moba.de>
     * @copyright MOBA
     * @comment  PRODUCT TYPE DELETE RECORDS
     * @date 2022-07-13
     */
    public function destroy(Request $request) {
        $record = ProductType::where('id', $request->id)->update(['is_active' => 0 , 'deleted_at' => date('Y-m-d H:i:s')]);
        // $record = ProductType::destroy($request->id);
            if ($record) {
                insertSystemLog('Delete Product Type From Web App',ucfirst(auth()->user()->name).' Delete Product Type From Web App',$request->header('user-agent'));
                return endRequest('Success', 200, 'Record Deleted Successfully.');
            } else {
                return endRequest('Error', 205, 'Record not found.');
            }
    }
}
