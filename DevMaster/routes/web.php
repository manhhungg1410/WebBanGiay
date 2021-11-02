<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Demo route
Route::get('/demo',function() {
    return 'xin chao Viet Nam';
});
// Truyền tham số trên route
Route::get('/hoten/{ten}',function($ten){
    return 'hello' . $ten;
});
Route::get('/thongtin/{ok}/{gg}',function($ten,$tuoi){
    return 'hello ' . $ten . ' '.$tuoi;
});

Route::get('/demo_2',[\App\Http\Controllers\TestController::class,'testSQL']);

/*
 * CODE MAIN
 */
/*
 * -------- CODE BACKEND -----------
 */

/*
 * LOGIN ADMIN
 */
Route::get('admin/login',[AdminController::class,'login'])->name('admin_login');
Route::post('admin/postLogin',[AdminController::class,'postLogin'])->name('adminPostLogin');
Route::get('admin/logout',[AdminController::class,'logout'])->name('admin_logout');
// Trang đăng ký user dự phòng
Route::get('admin/sign_up',[AdminController::class,'sign_up'])->name('sign_up');
Route::post('admin/confirm',[AdminController::class,'confirm'])->name('confirmsign_up');
/*
 * END LOGIN ADMIN
 */



/*
 * Admin
 */
Route::group(['prefix'=>'admin','as'=>'admin','middleware'=>'checkLogin'],function(){ // tạo group với url admin/...
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::get('/',[AdminController::class,'index2'])->name('admin');
    /*
    * Products
    */
    Route::resource('/products',ProductController::class)->middleware(['can:not_poster']);
    Route::get('/delete_all_products',[ProductController::class,'deleteAll'])->name('deleteProduct');
    Route::get('/add_images/{id}',[ProductController::class,'add_images'])->name('add_images')->middleware(['can:not_poster']);
    /*
     * End Products
     */

    /*
     * Product-Image
     */
    Route::resource('/product_images',ProductImageController::class)->middleware(['can:not_poster']);
    Route::get('/delete_all_productsImages',[ProductImageController::class,'deleteAll'])->name('deleteProductImage');
    /*
     * End Product-Image
     */

    /*
     * Banner
     */
    Route::resource('/banner',BannerController::class)->middleware(['can:not_poster']);
    Route::get('/delete_all_banners',[BannerController::class,'deleteAll'])->name('deleteBanners');
    /*
     * End Banner
     */

    /*
     * User
     */
    Route::resource('/user',UserController::class);
    Route::get('delete_all_users',[UserController::class,'deleteAll'])->name('deleteUsers');
    Route::post('user/role_change/{id_user}',[UserController::class,'role_change'])->name('role_change');
    Route::get('/user/change_password/{id}',[UserController::class,'change_password'])->name('change_pass');
    Route::post('/user/confirm_change/{id}',[UserController::class,'confirm_change'])->name('confirm_change');
    /*
     * End User
     */

    /*
     * Role
     */
    Route::resource('/role',\App\Http\Controllers\RoleController::class);
    Route::get('/detele_role/{id}',[\App\Http\Controllers\RoleController::class,'delete_ajax'])->name('delete_role');
    /*
     * End Role
     */

    /*
     * Category
     */
    Route::resource('/categories',CategoryController::class)->middleware(['can:not_poster']);
    Route::get('/delete_all_categories',[CategoryController::class,'deleteAll'])->name('deleteCategory');
    /*
     * End Category
     */

    /*
     * Articles
     */
    Route::resource('/articles',ArticleController::class)->middleware(['can:not_editor']);
    Route::get('/delete_all_articles',[ArticleController::class,'deleteAll'])->name('deleteArticle');
    /*
     * End Article
     */

    /*
     * Brands - Thương hiệu sản phẩm
     */
    Route::resource('/brands',BrandController::class)->middleware(['can:not_poster']);
    Route::get('/delete_all_brands',[BrandController::class,'deleteAll'])->name('deleteAll');
    /*
     * End Brands
     */

    /*
     * Contact
     */
    Route::resource('/contacts',\App\Http\Controllers\ContactController::class)->middleware(['can:not_poster']);
    Route::get('/delete_contact/{id}',[\App\Http\Controllers\ContactController::class,'deleteContact'])->name('deleteContact');
    /*
     * End Contact
     */

    /*
    * Policies
    */
    Route::resource('/policies',\App\Http\Controllers\PolicyController::class)->middleware(['can:not_poster']);
    Route::get('/delete_policy/{id}',[\App\Http\Controllers\PolicyController::class,'deletePolicy'])->name('deletePolicy');
    /*
     * End Policies
     */

});
/*
 * End Admin
 */




/*
 * ----------- CODE FRONTEND -------------
 */

/*
 * Home Page
 */
Route::get('/',[\App\Http\Controllers\ShopController::class,'index'])->name('home_page');
Route::get('/details_product/{slug1}/{slug2}',[\App\Http\Controllers\ShopController::class,'products'])->name('products_show');
Route::get('/details_product/{slug}',[\App\Http\Controllers\ShopController::class,'details_product'])->name('details_product');
Route::get('/search_items',[\App\Http\Controllers\ShopController::class,'searchProducts'])->name('searchProducts');
Route::get('/checkout',[\App\Http\Controllers\ShopController::class,'checkout'])->name('checkout');
Route::get('/cart',[\App\Http\Controllers\ShopController::class,'cart'])->name('cart');
Route::get('/policies/{id}',[\App\Http\Controllers\ShopController::class,'policies'])->name('policies');
Route::get('/login_guest',[\App\Http\Controllers\ShopController::class,'view_login'])->name('view_login');

//For Guest
Route::group(['middleware'=>'checkLoginGuest'],function() { // tạo group với url admin/...
    Route::get('show_information',[\App\Http\Controllers\ShopController::class,'information_guest'])->name('information_guest');
    Route::post('/guest/change_password/{id}',[\App\Http\Controllers\ShopController::class,'change_pass_guests'])->name('change_pass_guests');
    Route::post('/guest/update_guest/{id}',[\App\Http\Controllers\ShopController::class,'update_guest'])->name('update_guest');
});

//Contact
Route::get('/contact',[\App\Http\Controllers\ShopController::class,'contact'])->name('contact');
// End Contact
Route::get('/about_us',[\App\Http\Controllers\ShopController::class,'about_us'])->name('about_us');
//Blog
Route::get('/blogs',[\App\Http\Controllers\ShopController::class,'blogs'])->name('blogs');
Route::get('/blogs/{slug}',[\App\Http\Controllers\ShopController::class,'find_blog'])->name('find_blog');
//End Blog
Route::get('/not_found',[\App\Http\Controllers\ShopController::class,'not_found'])->name('not_found');
/*
 * End Home Page
 */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
 * Login Guest
 */

Route::post('/post_login',[\App\Http\Controllers\ShopController::class,'postLogin'])->name('login_guest');
Route::get('/logout_guest',[\App\Http\Controllers\ShopController::class,'logout_guest'])->name('logout_guest');
Route::post('/post_register',[\App\Http\Controllers\ShopController::class,'post_register'])->name('post_register');
