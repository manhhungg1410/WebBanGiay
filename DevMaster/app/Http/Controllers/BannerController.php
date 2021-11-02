<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\RequestBanner;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // return index.blade.php in folder banner.
        $is_active = $request->is_active;
        $type = $request->type;

        if(($is_active==null && $type==null) || ($is_active=='-'&&$type=='-')){
                   $lsBanner = Banner::paginate(10);
        }else if($is_active=='-' && $type!='-'){
            $lsBanner = Banner::where('type','=',$type)->paginate(10);
        }else if($is_active!='-' && $type=='-'){
            $lsBanner = Banner::where('is_active','=',$is_active)->paginate(10);
        }else{
            $lsBanner = Banner::where('is_active','=',$is_active)
                ->where('type','=',$type)->paginate(10);
        }

        return view('backend/banner/index')->with(['lsBanner'=>$lsBanner,'type'=>$type,'is_active'=>$is_active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return add.blade.php in folder banner
        return view('backend/banner/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestBanner $request)
    {
        $params = $request->all();
        $banner = new Banner();
        $banner->title = $params['title'];
        $banner->slug = Str::of($params['title'])->slug();
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/banners/';
            // upload file
            $file->move($path,$filename);

            $banner->image = $path.$filename;
        }
        $banner->position = $params['position'];
        $banner->target = $params['target'];
        $banner->type = $params['type'];
        $banner->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        $banner->url = $params['url'];
        $banner->description = $params['description'];

        $banner->save();
        Alert::success('Thành công!','Thêm mới Banner thành công');
        return redirect()->route('adminbanner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lsBanner = Banner::find($id);
        return view('backend.banner.show')->with(['banner'=>$lsBanner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return edit banner
        $banner = Banner::find($id);
        return view('backend/banner.edit')->with(['banner'=>$banner]);
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
        $banner = Banner::find($id);
        $banner->title = $params['title'];
        $banner->slug = Str::of($params['title'])->slug();
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/banners/';
            // upload file
            $file->move($path,$filename);

            $banner->image = $path.$filename;
        }
        $banner->position = $params['position'];
        $banner->target = $params['target'];
        $banner->type = $params['type'];
        $banner->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        $banner->url = $params['url'];
        $banner->description = $params['description'];

        $banner->save();

        Alert::success('Thành công','Cập nhật Banner thành công');
        return redirect()->route('adminbanner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteAll(Request $request){
        if($request->checkDelete==null){
//            alert()->warning('Không thành công','Vui lòng chọn bản ghi muốn xóa');
//            return redirect()->back();
        }else{
            $lsId = $request->checkDelete;
            //    dd($lsId);
            foreach($lsId as $id){
                Banner::find($id)->delete();
            }
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }
    }
}
