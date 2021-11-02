<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\RequestCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $lsFull = Category::all();
       // dd($name);
        if($name == null){
            $lsCategories = Category::paginate(10);
        }else{
            $lsCategories = Category::where('name','like','%'.$name.'%')
                            ->paginate(5);
        }
      // dd($lsCategories);

        return view('backend/category.index')->with(['lsCategories'=>$lsCategories,'name'=>$name,'lsFull'=>$lsFull]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lsCategories = Category::all();
        return view('backend/category.add')->with(['lsCategories'=>$lsCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCategory $request)
    {
        //Lấy toàn bộ param từ form
        $params=$request->all();
//        dd($param);
        $categories = new Category();
        // Xử lý ảnh:


        // end
        $categories->name = $params['name'];
        $categories->slug = Str::of($params['name'])->slug();
        $categories->parent_id = isset($params['parent_id']) ? $params['parent_id'] : 0;
        $categories->position = $params['position'];
        $categories->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        // xử lý ảnh
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/categories/';
            // upload file
            $file->move($path,$filename);

            $categories->image = $path.$filename;
        }

        $categories->save();
        alert()->success('Thành công','Thêm mới danh mục thành công');
        return redirect()->route('admincategories.index');
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
        $lsCategories = Category::all();
        $categories = Category::find($id);
        return view('backend/category.edit')->with(['categories'=>$categories,'lsCategories'=>$lsCategories]);
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
        $categories = Category::find($id);
        $categories->parent_id = $params['parent_id'];
        $categories->name = $params['name'];
        $categories->slug = Str::of($params['name'])->slug();

        $categories->position = $params['position'];
        // kiểm tra param is_active có rỗng ko nếu ko thì lưu vào db
        $categories->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        // xử lý lưu ảnh
        if ($request->hasFile('image')) { // kiểm tra xem có file gửi lên không
            // get file được gửi lên
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();  // $file->getClientOriginalName() = lấy tên gốc của file
            // duong dan upload
            $path_upload = 'upload/categories/';
            // upload file
            $file->move($path_upload,$filename);

            $categories->image = $path_upload.$filename;
        }

        $categories->save();
        alert()->success('Thành công','Cập nhật danh mục thành công');
        return redirect()->route('admincategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brands = Category::find($id);
        $brands->delete();
        return redirect()->back()->with(['delete_success'=>'Xóa thành công']);
    }

    public function deleteAll(Request $request){
           if($request->checkDelete==null){
//               alert()->warning('Không thành công','Vui lòng chọn bản ghi muốn xóa');
//               return redirect()->back();
           }else{
               $lsId = $request->checkDelete;
               foreach($lsId as $id){
                   Category::where('id','=',$id)->delete();
               }
              return response()->json([
                  'code' => 200,
                  'message' => 'success'
              ],200);
           }
    }
}
