<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\RequestArticle;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        if ($title == null)
            $lsArticle = Article::latest()->paginate(10);
        else
            $lsArticle = Article::where('title', 'like', '%' . $title . '%')->latest()->paginate(10);
        return view('backend.article.index')->with(['lsArticle' => $lsArticle, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.article.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestArticle $request)
    {
        $params = $request->all();

        $article = new Article();

        $article->title = $params['title'];
        $article->slug = Str::of($params['title'])->slug();
        if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
            // get file image
            $file = $request->file('image');
            // đặt lại tên cho file
            $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
            // dd($filename);
            // đường dẫn upload
            $path = 'upload/articles/';
            // upload file
            $file->move($path,$filename);

            $article->image = $path.$filename;
        }
        $article->type = $params['type'];
        $article->position = $params['position'];
        $article->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
        $article->url = $params['url'];
        $article->summary = $params['summary'];
        $article->description = $params['description'];
        $article->meta_title = $params['meta_title'];
        $article->meta_description = $params['meta_description'];
        $article->user_id = Auth::user()->id;
        $article->save();
        alert()->success('Thành công','Thêm mới sản phẩm thành công');
        return redirect()->route('adminarticles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $user = User::all();
        return view('backend.article.show')->with(['article'=>$article,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        if($article->user_id == Auth::user()->id || Auth::user()->role->name=="Admin") {
            return view('backend.article.edit')->with(['article' => $article]);
        }
        else{
            alert()->warning('Không thành công','Bạn không thể cập nhật bài viết của người khác');
            return redirect()->route('adminarticles.index');
        }
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

        $article =  Article::find($id);


            $article->title = $params['title'];
            $article->slug = Str::of($params['title'])->slug();
            if($request->hasFile('image')){ // kiểm tra người dùng có nhập file lên ko
                // get file image
                $file = $request->file('image');
                // đặt lại tên cho file
                $filename = time().'_'.$file->getClientOriginalName();//lấy tên gốc của file
                // dd($filename);
                // đường dẫn upload
                $path = 'upload/articles/';
                // upload file
                $file->move($path,$filename);

                $article->image = $path.$filename;
            }
            $article->type = $params['type'];
            $article->position = $params['position'];
            $article->is_active = isset($params['is_active']) ? $params['is_active'] : 0;
            $article->url = $params['url'];
            $article->summary = $params['summary'];
            $article->description = $params['description'];
            $article->meta_title = $params['meta_title'];
            $article->meta_description = $params['meta_description'];
            $article->save();
            alert()->success('Thành công','Cập nhật bài viết thành công');
            return redirect()->route('adminarticles.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function deleteAll(Request $request){
        if($request->checkDelete==null){

        }else{
            $lsId = $request->checkDelete;
            //    dd($lsId);
            foreach($lsId as $id){
                $articles =  Article::find($id);
                if($articles->user_id == Auth::user()->id || Auth::user()->role->name=="Admin"){
                    $articles->delete();
                }
                else{
                    return response()->json([
                        'status' => false,
                        'msg' => 'Bạn không thể chọn bài viết của người khác để xóa' ,
                    ]);
                }
            }
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);


        }
    }
}
