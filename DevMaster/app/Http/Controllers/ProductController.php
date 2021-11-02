<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $name = $request->name;
       $is_active = $request->is_active;
       $is_hot = $request->is_hot;

     //  dd($name,$is_active,$is_hot);

        if(($name == null && $is_active == "-" && $is_hot == "-") || ($name == null && $is_active == null && $is_hot == null)){
            $lsProduct = Product::latest()->paginate(10);
        } else if($name == null && ($is_active != "-" && $is_hot == "-")){
            $lsProduct = Product::where('is_active','=',$is_active)->latest()->paginate(5);
        } else if($name == null && ($is_active == "-" && $is_hot != "-")){
            $lsProduct = Product::where('is_hot','=',$is_hot)->latest()->paginate(5);
        } else if($name == null && ($is_active != "-" && $is_hot != "-")){
            $lsProduct = Product::where('is_active','=',$is_active)
                                ->where('is_hot','=',$is_hot)
                                 ->latest()
                                ->paginate(5);
        } else if($name != null && ($is_active == "-" && $is_hot =="-")){
            $lsProduct = Product::where('name','like','%'.$name.'%')->latest()->paginate(5);
        } else if($name != null && ($is_active != "-" && $is_hot =="-")){
            $lsProduct = Product::where('name','like','%'.$name.'%')
                                ->where('is_active','=',$is_active)->latest()->paginate(5);
        } else if($name != null && ($is_active == "-" && $is_hot !="-")){
            $lsProduct = Product::where('name','like','%'.$name.'%')
                        ->where('is_hot','=',$is_hot)->latest()->paginate(5);
        } else if($name != null && ($is_active != "-" && $is_hot !="-")){
            $lsProduct = Product::where('name','like','%'.$name.'%')
                ->where('is_active','=',$is_active)
                ->where('is_hot','=',$is_hot)->latest()->paginate(5);
        }
      //  dd($lsProduct);
        return view('backend.product.index')->with(['lsProduct'=>$lsProduct,'name'=>$name,'is_active'=>$is_active,'is_hot'=>$is_hot]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lsCategory = Category::all();
        $lsBrand = Brand::all();
        return view('backend.product.add')->with(['lsCategory'=>$lsCategory,'lsBrand'=>$lsBrand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestProduct $request)
    {
        $params = $request->all();

        $product = new Product();

        $product->name = $params['name'];
        $product->slug = Str::of($params['name'])->slug();
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/products/';
            // upload file
            $file->move($path,$filename);

            $product->image = $path.$filename;
        }
        $product->stock = $params['stock'];
        $product->price = $params['price'];
        $product->sale = $params['sale'];
        $product->position = $params['position'];
        $product->color = $params['color'];
        $product->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        $product->is_hot = isset($params['is_hot']) ? $params['is_hot'] : 0;
        $product->url = $params['url'];
        $product->summary = $params['summary'];
        $product->description = $params['description'];
        $product->meta_title = $params['meta_title'];
        $product->meta_description = $params['meta_description'];
        $product->category_id = $params['category_id'];
        $product->brand_id = $params['brand_id'];
        $product->user_id = Auth::user()->id;
        $product->save();
        alert()->success('Thành công','Thêm mới sản phẩm thành công');
        return redirect()->route('adminproducts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $user = User::all();
       // dd($user);
        return view('backend.product.show')->with(['product'=>$product,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lsCategory = Category::all();
        $lsBrand = Brand::all();
        $product = Product::find($id);
        return view('backend.product.edit')->with(['product'=>$product,'lsCategory'=>$lsCategory,'lsBrand'=>$lsBrand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();

        $product = Product::find($id);

        $product->name = $params['name'];
        $product->slug = Str::of($params['name'])->slug();
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/products/';
            // upload file
            $file->move($path,$filename);

            $product->image = $path.$filename;
        }
        $product->stock = $params['stock'];
        $product->price = $params['price'];
        $product->sale = $params['sale'];
        $product->position = $params['position'];
        $product->color = $params['color'];
        $product->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        $product->is_hot = isset($params['is_hot']) ? $params['is_hot'] : 0;
        $product->url = $params['url'];
        $product->summary = $params['summary'];
        $product->description = $params['description'];
        $product->meta_title = $params['meta_title'];
        $product->meta_description = $params['meta_description'];
        $product->category_id = $params['category_id'];
        $product->brand_id = $params['brand_id'];

        $product->save();
        alert()->success('Thành công','Cập nhật sản phẩm thành công.');
        return redirect()->route('adminproducts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('adminproducts.index')->with(['delete_success'=>'Xóa thành công']);
    }

    public function deleteAll(Request $request){
        if($request->checkDelete==null){
//            alert()->warning('Không thành công','Vui lòng chọn bản ghi muốn xóa');
//            return redirect()->back();
        }else{
            $lsId = $request->checkDelete;
        //    dd($lsId);
            foreach($lsId as $id){
                Product::find($id)->delete();
            }
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }
    }

    public function add_images($id){
        $lsProduct = Product::all();
        $product_id = $id;
        return view('backend.product_image.add')->with(['lsProduct'=>$lsProduct,'product_id'=>$product_id]);
    }
}
