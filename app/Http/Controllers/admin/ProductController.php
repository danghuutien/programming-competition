<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    function add(){
        return view('admin.product.add');
    }
    function inser(Request $request){
        
        $slug = Str::slug($request->name);
        $file = $request->file;
      
        if(!empty($file)){
            $file->move('images/', $file->getClientOriginalName());
            $image1 = 'images/' . $file->getClientOriginalName();
        }
        $partner =  new Product();
        $partner->user_id = 1;
        $partner->category_id = 1;
        $partner->sku = Str::random(5);
        $partner->image  = $image1;
        $partner->name = $request->name;
        $partner->score  = $request->score;
        $partner->price  = $request->price;
        $partner->price_old  = $request->price_old;
        $partner->detail  = $request->detail;
        $partner->quantity  = $request->qty;
       
        $partner->save();
        session()->flash('sucess','Thêm mới thành công !');
        return redirect(route('product.index'));
    }

    function index(){
        $list_product = Product::get();
        return view('admin.product.index', compact('list_product'));
    }
    function edit($id){
        // $categorys = CategoryProduct::all();
         $product =Product::find($id);
        return view('admin.product.edit', compact('product'));
    }
    function update(Request $request, $id){
         
        $slug = Str::slug($request->name);
        $file = $request->file;
      
        if(!empty($file)){
            $file->move('images/', $file->getClientOriginalName());
            $image1 = 'images/' . $file->getClientOriginalName();
        }
        $partner =  Product::find($id);
        $partner->user_id = 1;
        $partner->category_id = 1;
        $partner->sku = Str::random(5);
        $partner->image  = $image1;
        $partner->name = $request->name;
        $partner->score  = $request->score;
        $partner->price  = $request->price;
        $partner->price_old  = $request->price_old;
        $partner->detail  = $request->detail;
        $partner->quantity  = $request->qty;
       
        $partner->save();
        session()->flash('sucess','Thêm mới thành công !');
        return redirect(route('product.index'));
    }
    function delete($id){
        Product::where('id',$id)->delete();
        return redirect(route('product.index')) ;
    }
}
