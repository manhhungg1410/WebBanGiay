<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Requests\RequestProductImage;
use Illuminate\Support\Facades\DB;

class ProductImageController extends Controller
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

        $lsDifferent = Product::selectRaw('products.id,products.name,products.image,count(product_images.id) as soluong')
            ->leftjoin('product_images','products.id','=','product_images.product_id')
            ->groupBy('products.id','products.name','products.image')
           // ->havingRaw('soluong < ?',[5])
               ->having('soluong','<',2)
            ->get();

        if($name==null && ($is_active==null || $is_active=="-")){
            $lsProductImage = ProductImage::latest()->paginate(10);
        }else if($name==null && $is_active!="-"){
            $lsProductImage = ProductImage::where('is_active','=',$is_active)->latest()->paginate(10);
        }else if($name!=null && $is_active=="-"){
//            $lsProductImage = DB::table('products')
//            ->join('product_images','products.id','=','product_images.product_id')
//            ->select('product_images.id','products.name as name','product_images.image','product_images.url','product_images.position','product_images.is_active','product_images.created_at')
//            ->where('products.name','like','%'.$name.'%')
//            ->paginate(10);
            // Truy vấn sql
            $lsProductImage = ProductImage::select('product_images.*')
                ->join('products','products.id','=','product_images.product_id')
                ->where('products.name','like','%'.$name.'%')
                ->latest()
                ->paginate(10);
            //dd($lsProductImage);
        }else if($name!=null && $is_active!="-"){
//            $lsProductImage = DB::table('products')
//                ->join('product_images','products.id','=','product_images.product_id')
//                ->select('product_images.id','products.name as name','product_images.image','product_images.url','product_images.position','product_images.is_active','product_images.created_at')
//                ->where('products.name','like','%'.$name.'%')
//                ->where('product_images.is_active','=',$is_active)
//                ->paginate(10);
            $lsProductImage = ProductImage::select('product_images.*')
                ->join('products','products.id','=','product_images.product_id')
                ->where('products.name','like','%'.$name.'%')
                ->where('product_images.is_active','=',$is_active)
                ->latest()
                ->paginate(10);
        }

      return view('backend.product_image.index')->with(['lsProductImage'=>$lsProductImage,'lsDifferent'=>$lsDifferent,'name'=>$name,'is_active'=>$is_active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product_id = $request->product_id;
        $lsProduct = Product::all();
        //dd($product_id);
        if($product_id==null){
            return view('backend.product_image.add')->with(['lsProduct'=>$lsProduct]);
        }
        else{
            return view('backend.product_image.add')->with(['lsProduct'=>$lsProduct,'product_id'=>$product_id]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestProductImage $request)
    {
        $params = $request->all();
        $product_images = new ProductImage();
        $product_images->product_id = $params['product_id'];
        $product_images->url = $params['url'];
        $product_images->position = $params['position'];
        $product_images->is_active = isset($params['is_active']) ? $params['is_active'] : 0;

        // xử lý ảnh
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/product_images/';
            // upload file
            $file->move($path,$filename);

            $product_images->image = $path.$filename;
        }
        $product_images->save();
        alert()->success('Thành công','Thêm mới ảnh sản phẩm thành công');
        return redirect()->route('adminproduct_images.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_images = ProductImage::find($id);
        $lsProduct = Product::all();
        return view('backend.product_image.edit')->with(['product_images'=>$product_images,'lsProduct'=>$lsProduct]);
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
        $product_images = ProductImage::find($id);
        $params = $request->all();

        $product_images->product_id = $params['product_id'];
        $product_images->url = $params['url'];
        $product_images->position = $params['position'];
        $product_images->is_active = isset($params['is_active']) ? $params['is_active'] : 0;

        // xử lý ảnh
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/product_images/';
            // upload file
            $file->move($path,$filename);

            $product_images->image = $path.$filename;
        }
        $product_images->save();
        alert()->success('Thành công','Cập nhật ảnh sản phẩm thành công');
        return redirect()->route('adminproduct_images.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_images = ProductImage::find($id);
        $product_images->delete();
        return redirect()->back()->with(['delete_success'=>'Xóa thành công']);
    }

    public function deleteAll(Request $request){
        if($request->checkDelete==null){
//            alert()->warning('Không thành công','Vui lòng chọn bản ghi muốn xóa');
//            return redirect()->back();
        }else{
            $lsId = $request->checkDelete;
            foreach($lsId as $id){
                ProductImage::where('id','=',$id)->delete();
            }
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }
    }
}
