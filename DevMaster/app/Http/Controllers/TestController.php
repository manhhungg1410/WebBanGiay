<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class TestController extends Controller
{
    public function testSQL(){
        // đếm số lượng ảnh mỗi sản phẩm
        $products = DB::table('products')
        //    ->select('products.id','products.name', DB::raw('count(product_images.id) as soluong'))
         //   ->select('products.id','products.name')
            ->selectRaw('products.id,products.name,products.image,count(product_images.id) as soluong')
            ->leftjoin('product_images','products.id','=','product_images.product_id')
            ->groupBy('products.id','products.name,products.image')
            ->havingRaw('soluong = ?',[0])
            ->get();
     //  dd($products->count());


        //Truy vấn con
        $categories = Category::select('id','parent_id');

        $test = Category::selectRaw('categories.id,categories.name,count(lsCategories.id) as soluong')
            ->joinSub($categories,'lsCategories', function ($join) {
                $join->on('categories.id', '=', 'lsCategories.parent_id');
            })->groupBy('categories.id','categories.name')->get();
//        dd($test);
        return view('demoFile.index')->with(['products'=>$products]);
    }
}
