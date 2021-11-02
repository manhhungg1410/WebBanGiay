<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Requests\PolicyRequest;
use mysql_xdevapi\Exception;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lsPolicies = Policy::paginate(10);
        return view('backend.policy.index')->with(['lsPolicies'=>$lsPolicies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.policy.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolicyRequest $request)
    {
        $policy = new Policy();
        $policy->name = $request->name;
        $policy->is_active = isset($request->is_active) ? $request->is_active : 0;
        $policy->description = $request->description;
        $policy->save();
        alert()->success('Thành công','Successfully Added New');
        return redirect()->route('adminpolicies.index');
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
        $policy = Policy::find($id);
        return view('backend.policy.edit')->with(['policy'=>$policy]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PolicyRequest $request, $id)
    {
        $policy = Policy::find($id);
        $policy->name = $request->name;
        $policy->is_active = isset($request->is_active) ? $request->is_active : 0;
        $policy->description = $request->description;
        $policy->save();
        alert()->success('Thành công','Update Successful');
        return redirect()->route('adminpolicies.index');
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

    public function deletePolicy($id){
            $policy = Policy::find($id);
            $policy->delete();
            return response()->json([
                'code'=> 200,
                'message'=> 'success'
            ],200);
    }
}
