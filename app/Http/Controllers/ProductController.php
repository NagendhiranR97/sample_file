<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use DataTables;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function product()
    {
        return view('product');
    }

    public function viewproduct()
    {
        return view('product');
    }

    public function add_product(Request $request)
    {

        $request->validate([
            'productimg' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);
        $productnewImagename = time().'_'.$request['productname'].'.'.$request['productimg']->extension();
        $testImages = $request['productimg']->move(public_path('images'), $productnewImagename);
        
        $product = new Product();
        $product->productname = $request['productname'];
        $product->productcat = $request['productcat'];
        $product->productmodel = $request['productmodel'];
        $product->productsp = $request['productsp'];
        $product->productcp = $request['productcp'];
        $product->productgst = $request['productgst'];
        $product->productsgst = $request['productsgst'];
        $product->productcgst = $request['productcgst'];
        $product->productimg = $productnewImagename;
        $product->productdesc = $request['productdesc'];

        $product->save();

        return response()->json(['success' => 'Product Created Successfully']);
    }

    public function usersview(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('productimg', function ($data) { 
                        $url= asset('images/'.$data->productimg);
                        return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                    })
                    ->addColumn('action', function($row){
     
                           
                           
                           $x = '
                           <a href="{{route(\'project.edit\',$row->id)}}">
                           <i class="fas fa-cog"></i>
                           </a>
                           <form action="" method="POST">
                    '.csrf_field().'
                    '.method_field("DELETE").'
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm(\'Are You Sure Want to Delete?\')"
                        style="padding: .0em !important;font-size: xx-small;"><a href="javascript:void(0)" onclick="deleteproduct('. $row->id .')" class="edit btn btn-danger btn-sm">Delete</a></a>
                    </form>
                          
                       ';
                           return $x;
                          
                    })
                    ->rawColumns(['productimg', 'action'])
                    ->make(true);
        }
        
        return view('usersview');
    }


    public function deleteproduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json(['success' => 'Product Deleted Successfully']);
        
    }
}
