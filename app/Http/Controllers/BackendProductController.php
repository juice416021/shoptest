<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class BackendProductController extends Controller
{
    //保護功能 只有登入才能進行新增修改 沒登入的話只能進首頁和查看
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(Request $request)
    {
        $categories=Category::all();
        $products = Product::query();
        $keyword = $request->input('keyword', null);
        $category_id = $request->input('category_id', null);
        $state = $request->input('state', null);
        $startDate = $request->input('start_date', null);
        $endDate = $request->input('end_date', null);


        if (! is_null($keyword)) {
            $products = $products->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('id', $keyword);
            });
        }

        if (! is_null($category_id)) {
            $products = $products->where('category_id', $category_id );
        }

        if (! is_null($state)) {
            if ($state == 'published') {
                $products = $products->where('state', 'published' );
            } elseif ($state == 'draft') {
                $products = $products->where('state', 'draft' );
            }
        }

        if (! is_null($startDate)) {
            $products = $products->whereDate('created_at', '>=', $startDate);
        }

        if (! is_null($endDate)) {
            $products = $products->whereDate('created_at', '<=', $endDate);
        }

        $products = $products->with('category')->paginate(30);


        return view('backend.products.index', compact('products', 'keyword', 'state', 'startDate', 'endDate','categories'));
    }




}
