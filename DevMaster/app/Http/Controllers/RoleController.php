<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if( $this->authorize('admin_manager')){
           $lsRole = Role::paginate(10);
           return view('backend.role.index')->with(['lsRole'=>$lsRole]);
       }
       else abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           if( $this->authorize('admin')){
               return view('backend.role.add');
           }
           else abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên quyền'
        ];
        $params = $request->all();

        $validator = Validator::make($params, $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        }

        $role->name = $params['name'];
        $role->save();
        alert()->success('Thành công','Thêm mới quyền hạn thành công');
        return redirect()->route('adminrole.index');
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
       if( $this->authorize('admin')){
           $role = Role::find($id);
           return view('backend.role.edit')->with(['role'=>$role]);
       }else abort(403);

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
        $role = Role::find($id);
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Vui lòng nhập tên quyền'
        ];
        $params = $request->all();

        $validator = Validator::make($params, $rules, $messages);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        }

        $role->name = $params['name'];
        $role->save();
        alert()->success('Thành công','Cập nhật quyền hạn thành công');
        return redirect()->route('adminrole.index');

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

    public function delete_ajax($id){
        Role::find($id)->delete();
        return response()->json([
            'code'=> 200,
            'message'=> 'success'
        ],200);
    }
}
