<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\RequestBrand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Lấy toàn bộ dữ liệu từ bảng
        // select * from brands
        $name = $request->name;
        if($name!=null){
            $lsBrands = Brand::where('name','like','%'.$name.'%')->paginate(5);
        }else  $lsBrands = Brand::paginate(10);

        return view('backend/brands/index')->with(['lsBrands'=>$lsBrands,'name'=>$name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend/brands/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestBrand $request)
    {
            //Lấy toàn bộ param từ form
            $params=$request->all();
            $brands = new Brand();
            // Xử lý ảnh:


            // end
            $brands->name = $params['name'];
            $brands->slug = Str::of($params['name'])->slug();
            $brands->website = $params['website'];
            $brands->position = $params['position'];
            $brands->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
            // xử lý ảnh
            if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
                // get file image
                $file = $request->file('image');
                // đặt lại tên cho file
                $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
                // dd($filename);
                // đường dẫn upload
                $path = 'upload/brands/';
                // upload file
                $file->move($path,$filename);

                $brands->image = $path.$filename;

            }
            $brands->save();

        Alert::success('Thành công', 'Thêm mới thương hiệu thành công');
      //  alert()->success('Thành công','Thêm mới thương hiệu thành công');
       // return redirect()->route('adminbrands.index')->with(['createSuccess'=>'Thêm mới thành công']);
        return redirect()->route('adminbrands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find thằng có id = $id;
        $brands = Brand::find($id);
        return view('backend/brands/edit')->with(['brands'=>$brands]);
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
        // Lấy thông tin từ trang edit
        $params=$request->all();
        $brands = Brand::find($id);

        $brands->name = $params['name'];
        $brands->slug = Str::of($params['name'])->slug();
        $brands->website = $params['website'];
        $brands->position = $params['position'];
        // kiểm tra param is_active có rỗng ko nếu ko thì lưu vào db
        $brands->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        // xử lý lưu ảnh
        if ($request->hasFile('image')) { // kiểm tra xem có file gửi lên không
            // get file được gửi lên
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();  // $file->getClientOriginalName() = lấy tên gốc của file
            // duong dan upload
            $path_upload = 'upload/brands/';
            // upload file
            $file->move($path_upload,$filename);

            $brands->image = $path_upload.$filename;
        }

        $brands->save();

        alert()->success('Thành công','Cập nhật sản phẩm thành công.');
      //  return redirect()->route('adminbrands.index')->with(['update_success'=>'Cập nhật thành công']);
        return redirect()->route('adminbrands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = Brand::find($id);
        $brands->delete();
        return redirect()->back()->with(['delete_success'=>'Xóa thành công']);
    }

    public function deleteAll(Request $request){
//       // dd('Da vao day');
        if($request->checkDelete==null){
           // alert()->warning('Không thành công','Vui lòng chọn bản ghi muốn xóa');
//            return redirect()->back()->with(['errorDelete'=>'Vui lòng chọn bản ghi muốn xóa']);
           // return redirect()->back();

        }
        else
        {
            $id = $request->checkDelete;
            //dd($id);
            foreach($id as $items) {
                //  Brand::where('id','=',$ke)->delete();
                Brand::find($items)->delete();
            }
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
          //  return redirect()->back();
        }

    }
}
