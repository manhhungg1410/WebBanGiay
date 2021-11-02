<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        if($this->authorize('admin_manager'))
            return view('backend/admin.index');
        else abort(403);

    }

    public function index2(){
        return view('backend/admin.index2');
    }

    public function login(){
        return view('backend.admin.login');
    }

    public function postLogin(Request $request){
        $params = $request->all();
        //dd($params);
        $datas = [
          'email' => $params['email'],
            'password' => $params['password']
        ];

        if(Auth::attempt($datas,$request->has('remember'))){
            return redirect()->route('adminadmin');
        }
        alert()->error('Oops!!','Vui lòng kiểm tra lại email hoặc mật khẩu');
        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        alert()->success('Goodbye!','See you again!!!');
        return redirect()->route('admin_login');
    }

    public function sign_up(){
        $lsRole = Role::all();
        return view('backend.user.sign_up')->with(['lsRole'=>$lsRole]);
    }

    public function confirm(Request $request){
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
        return redirect()->back();
    }
}
