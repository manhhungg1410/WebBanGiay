<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Policy;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function __construct()
    {

        $lsCategories = Category::where('is_active','=','1')
            ->get();
        $lsBanner = Banner::where('is_active','=','1')
            ->where('type','=','0')
            ->orderby('position','asc')
            ->take(3)->get();
        // dd($lsBanner);
        $lsPolicies = Policy::where('is_active',1)->get();
        view()->share([
            'lsCategories'=>$lsCategories,
            'lsBanner'=>$lsBanner,
            'lsPolicies'=>$lsPolicies,
        ]);
    }

    // Hàm trả về trang chủ
    public function index(){
        $categories = Category::where('is_active','=','1')
            ->where('parent_id','=','0')
            ->orderby('position','asc')->take(3)->get();
        $articles = Article::where('is_active','=','1')
            ->latest()->take(3)->get();
        $list = [];
        $lsParent = Category::where('parent_id',0)->get();
        foreach($lsParent as $parent){
            $listID = [];
            $lsCategory = Category::all();
            foreach($lsCategory as $child){
                if($child->parent_id==$parent->id){
                    $listID[] = $child->id;
                }
            }
            $lsProducts = Product::where('is_active',1)->where('is_hot',1)->wherein('category_id',$listID)->take(10)->get();
            $list[] = [
                'name' => $parent->name,
                'lsProduct' => $lsProducts,
                 'slug' => $parent->slug,
            ];
        }
        $lsBrands = Brand::all();

        return view('frontend/content_pages/home')->with(['categories'=>$categories,
                                                            'articles'=>$articles,
                                                            'list'=>$list,
                                                            'lsBrands'=>$lsBrands]);
    }

    // Show thông tin sản phẩm qua modal
    public function details_ajax($id){
        return [
            Product::find($id),
        ];
    }

    // Hàm xử lý show thông tin chi tiết sản phẩm
    public function products($slug_cate,$slug_pro){
        $product = Product::where('slug',$slug_pro)->first();
        $id = $product->id;
        // Viewed Products
        /*
         *   Hiển thị sản phẩm đã xem thông qua cookie
         */
        $lsViewed = null;
        if(isset($_COOKIE['list_id_products'])){
            $str_list_id = $_COOKIE['list_id_products'];    // Lấy chuỗi json từ cookie
            $arr_list = json_decode($str_list_id);  // trả về arr id
            $arr_list[] = $id;
            $str_json_id = json_encode($arr_list);  // trả lại chuỗi json cho cookie
            setcookie('list_id_products',$str_json_id,time() + (30*86400));
        }
        else{
            $list_id_products = [$id];
            $string_json_list = json_encode($list_id_products);  // trả lại chuỗi json cho cookie
            setcookie('list_id_products',$string_json_list,time() + (30*86400));
        }


        if(!empty($_COOKIE['list_id_products'])){
            //[57,57,58,58]
            $json_ids = $_COOKIE['list_id_products'];
            $arr_id = json_decode($json_ids);
            $list_unique_id = array_unique($arr_id);
            $lsViewed = Product::where('is_active',1)
                ->where('id','<>',$id)
                ->wherein('id',$list_unique_id)->get();
        }



        $lsProduct = Product::where('category_id','=',$product->category_id)->take(10)->get();
      //  dd($lsProduct);

        $product_img = ProductImage::where('product_id',$id)
            ->where('is_active',1)
            ->orderby('position','asc')
            ->get();

        return view('frontend/content_pages/product_details')->with(['product' => $product,'product_img'=>$product_img,'lsProduct'=>$lsProduct,'lsViewed'=>$lsViewed]);
    }


    // Hàm show danh sách sản phẩm theo danh mục sản phẩm
    public function details_product($slug){
        $categories = Category::where('slug','=',$slug)->first();

            if($categories==null){
                $lsProduct = Product::paginate(20);
            }
            else{
                if($categories->parent_id == 0){
                    $lsCategories = Category::all();
                    $list = [];
                    foreach($lsCategories as $items){
                        if($items->parent_id == $categories->id){
                            $list[] = $items->id;
                        }
                    }
                    $lsProduct = Product::wherein('category_id',$list)->paginate(20); // Lấy danh sách sp nếu user chọn danh mục có parent_id cha
                }else{
                    $lsProduct = Product::where('category_id','=',$categories->id)->paginate(20); // Lấy danh sách sp nếu user chọn danh mục kp là cha
                }
            }

           // dd($lsProduct);
        return view('frontend/content_pages/products')->with(['lsProduct'=>$lsProduct,'categories'=>$categories]);


    }

    // Show information policies
    public function policies($id){
        $policy = Policy::find($id);
        return view('frontend.content_pages.policies')->with(['policy'=>$policy]);
    }

    // Search sản phẩm
    public function searchProducts(Request $request){
        $name = $request->search;
        //dd($name);
        $lsProducts = Product::where('name','like','%'.$name.'%')->paginate(20);
        return view('frontend.content_pages.search_products')->with(['lsProducts'=>$lsProducts,'name'=>$name]);
    }

    // Show checkout page
    public function checkout(){
        return view('frontend/content_pages/checkout');
    }

    // Show cart page
    public function cart(){
        return view('frontend/content_pages/cart');
    }

    // Contact page
    public function contact(Request $request){
        if($request->email==null){
            return view('frontend/content_pages/contact');
        }
        else{
            $email = $request->email;
            return view('frontend/content_pages/contact')->with(['email'=>$email]);
        }
    }

    //about us
    public function about_us(){
        $userAdmin = User::where('email','=','hunq1410@gmail.com')
            ->take(1)->get();
        $lsUser = User::where('role_id','=',3)->take(1)->get();
        return view('frontend/content_pages/about_us')->with(['userAdmin'=>$userAdmin,'lsUser'=>$lsUser]);
    }

    // Show blogs page
    public function blogs(Request $request){
        $lsProduct = Product::where('is_active','=','1')
            ->orderby('price','desc')->take(5)->get();
        $categories = Category::where('parent_id',0)->where('is_active',1)->get();

        /*
         *  Search bài viết
         */
        $title = $request->search;
        if($request->search == null){
            $lsArticle = Article::where('is_active','=',1)->latest()->paginate(5);
        }
        else{
            $lsArticle = Article::where('is_active','=',1)
                ->where('title','like','%'.$title.'%')
                ->latest()->paginate(5);
        }
        return view('frontend/content_pages/blogs')->with(['lsArticle'=>$lsArticle,'categories'=>$categories,'lsProduct'=>$lsProduct,'title'=>$title]);
    }

    // SHow chi tiết bài viết
    public function find_blog($slug){
            $article = Article::where('slug','=',$slug)->first();
            $lsArticles = Article::where('is_active','=','1')
            ->latest()->take(3)->get();
        $categories = Category::where('parent_id',0)->where('is_active',1)->get();
            return view('frontend.content_pages.details_blog')->with(['article'=>$article,'lsArticle'=>$lsArticles,'categories'=>$categories]);
    }

    public function not_found(){
        return view('frontend/content_pages/404');
    }

    public function view_login(){
        return view('frontend.login');
    }

    // Login user web - Khách hàng
    public function postLogin(Request $request){
        $params = $request->all();
        //dd($params);
        $datas = [
            'email' => $params['email'],
            'password' => $params['password']
        ];

        if(Auth::attempt($datas,$request->has('remember'))){
            return redirect()->route('home_page');
        }
        alert()->error('Oops!!','Vui lòng kiểm tra lại email hoặc mật khẩu');
        return redirect()->back();
    }

    // đăng xuất
    public function logout_guest(){
        Auth::logout();
        alert()->success('Goodbye!','See you again!!!');
        return redirect()->route('home_page');
    }

    // thông tin khách
    public function information_guest(){
        // TT người dùng
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.content_pages.information_guest')->with(['user'=>$user]);
    }

    // Đổi mật khẩu
    public function change_pass_guests(Request $request,$id){
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
                return redirect()->route('home_page');
            }else{
                alert()->warning('Nhập lại mật khẩu mới không chính xác');
                return redirect()->back();
            }
        }else{
            alert()->warning('Bạn không nhập đúng mật khẩu cũ');
            return redirect()->back();
        }
    }

    // Cập nhật thông tin
    public function update_guest($id, Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required|max:10'
        ];
        $user = User::find($id);

        $params = $request->all();

        $validator = Validator::make($params, $rules);
       // dd($params);

        if ($validator->fails()) {
            alert()->warning('Error','Please fill in all the information');
            return redirect()->back();
        }
        else{
            $user->name = $params['name'];
            $user->email = $params['email'];
            $user->gender = $params['gender'];
            $user->phone = $params['phone'];
            $user->date = $params['date'];
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
            alert()->success('Success','Update Successful');
            return redirect()->back();
        }
    }

    // Xử lý đăng ký - Mặc định là Guests
    public function post_register(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'phone' => 'required|max:10',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        ];
        $params = $request->all();

        $validator = Validator::make($params, $rules);
        // dd($params);

        if ($validator->fails()) {
            alert()->warning('Error','Please fill in all the information or password confirm not true');
            return redirect()->back();
        }else{
            $user = new User();
            $user->name = $params['name'];
            $user->email = $params['email'];
            $user->phone = $params['phone'];
            $user->password = Hash::make($params['password']);
            $user->role_id = 6;
            $user->save();
            alert()->success('Success','Account successfully created');
            return redirect()->route('view_login')->with(['success'=>"Let's sign in now!!"]);
        }
    }

}
