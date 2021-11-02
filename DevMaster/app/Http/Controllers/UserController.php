<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RequestUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin_manager');
        $lsRole = Role::all();
        $name = $request->name;
        $role_id = $request->role_id;

        if($name==null && ($role_id==null || $role_id=="-")) {
            $lsUser = User::paginate(10);
        }else if($name==null && $role_id!="-"){
            $lsUser = User::where('role_id','=',$role_id)->paginate(10);
        }else if($name!=null && $role_id="-"){
            $lsUser = User::where('name','like','%'.$name.'%')->paginate(10);
        }else{
            $lsUser = User::where('name','like','%'.$name.'%')
                ->where('role_id','=',$role_id)
                ->paginate(10);
        }

        return view('backend.user.index')->with(['lsUser'=>$lsUser,'lsRole'=>$lsRole,'name'=>$name,'role_id'=>$role_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        $lsRole = Role::all();
        return view('backend.user.add')->with(['lsRole'=>$lsRole]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUser $request)
    {

        $params = $request->all();

        $user = new User();

        $user->name = $params['name'];
        if($request->hasFile('avatar')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('avatar');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/users/';
            // upload file
            $file->move($path,$filename);

            $user->avatar = $path.$filename;
        }
        $user->role_id = $request->role_id;
        $user->email = $params['email'];
        $user->password = Hash::make($request->password);
        $user->save();
        alert()->success('Thành công','Thêm mới người dùng thành công');
        return redirect()->route('adminuser.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
       //dd($request->all());
        $user = User::find($id);
        $lsRole = Role::all();
        $products = User::selectRaw('count(products.id) as soluong')
            ->join('products','products.user_id','=','users.id')
            ->where('users.id','=',$id)
            ->groupBy('users.id')->get();
     //   dd($products);
        $articles = User::selectRaw('count(articles.id) as soluong')
            ->join('articles','articles.user_id','=','users.id')
            ->where('users.id','=',$id)
            ->groupBy('users.id')->get();
        return view('backend.user.show')->with(['user'=>$user,'products'=>$products,'articles'=>$articles,'lsRole'=>$lsRole]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('admin');
        $user = User::find($id);
        $lsRole = Role::all();
        return view('backend.user.edit')->with(['user'=>$user,'lsRole'=>$lsRole]);
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


        $user = User::find($id);

        $user->name = $params['name'];
        $user->email = $params['email'];
        $user->gender = $params['gender'];
        $user->phone = $params['phone'];
        $user->skill = $params['skill'];
        $user->date = $params['date'];
        $user->address = $params['address'];
        $user->education = $params['education'];
        $user->description = $params['description'];
        $user->sayings = $params['sayings'];
        if($request->hasFile('avatar')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('avatar');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/users/';
            // upload file
            $file->move($path,$filename);

            $user->avatar = $path.$filename;
        }
        $user->save();
        alert()->success('Thành công','Cập nhật thông tin thành công');
        return redirect()->route('adminuser.show',$id);
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
            if ($request->checkDelete == null) {

            } else {
                $lsId = $request->checkDelete;
                foreach ($lsId as $id) {
                    User::find($id)->delete();
                }
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], 200);
            }
    }

    public function role_change($id_user,Request $request){
        $role = $request->role_id;
        $user = User::find($id_user);

        $user->role_id = $role;
        $user->save();

        alert()->success('Thay đổi quyền cho user thành công');
        return redirect()->route('adminuser.index');
    }

    public function change_password($id){
        if($id == Auth::user()->id){
            $user = User::find($id);
            return view('backend.user.change_pass')->with(['user'=>$user]);
        }
        else abort(403);
    }

    public function confirm_change($id,Request $request){
        $user = User::find($id);

        $rules = [
            'password' => 'required|min:8',
        ];

        $params = $request->all();

        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            alert()->warning('Vui lòng nhập lại mật khẩu mới.','Bạn chưa nhập mật khẩu mới hoặc mật khẩu mới chưa đủ 8 kí tự');
            return redirect()->back();
        }
       // dd($current_password,bcrypt($request->current_password));
        if(Hash::check($request->current_password,Auth::user()->password)){
            if($request->password == $request->confirm_password){
                $user->password = Hash::make($request->password);
                $user->save();
                alert()->success('Cập nhật mật khẩu mới thành công');
                return redirect()->route('adminuser.index');
            }else{
                alert()->warning('Nhập lại mật khẩu mới không chính xác');
                return redirect()->back();
            }
        }else{
            alert()->warning('Bạn không nhập đúng mật khẩu cũ');
            return redirect()->back();
        }

    }


}
