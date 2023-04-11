<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use function Sodium\randombytes_uniform;

class AdminController extends Controller
{
    //保護功能 只有登入才能進行新增修改 沒登入的話只能進首頁和查看
    public function __construct(){
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        return view('backend.index');
    }

}
