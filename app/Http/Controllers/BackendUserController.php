<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class BackendUserController extends Controller
{
    //保護功能 只有登入才能進行新增修改 沒登入的話只能進首頁和查看
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(Request $request)
    {
        $users = User::query();
        $keyword = $request->input('keyword', null);
        $isVerified = $request->input('verified', null);
        $startDate = $request->input('start_date', null);
        $endDate = $request->input('end_date', null);


        if (! is_null($keyword)) {
            $users = $users->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('id', $keyword);
            });
        }

        if (! is_null($isVerified)) {
            if ($isVerified == '1') {
                $users = $users->whereNotNull('email_verified_at');
            } elseif ($isVerified == '0') {
                $users = $users->whereNull('email_verified_at');
            }
        }

        if (! is_null($startDate)) {
            $users = $users->whereDate('created_at', '>=', $startDate);
        }

        if (! is_null($endDate)) {
            $users = $users->whereDate('created_at', '<=', $endDate);
        }

        $users = $users->paginate(10);

        return view('backend.users.index', compact('users', 'keyword', 'isVerified', 'startDate', 'endDate'));
    }


    public function show($id){
        $user = User::find($id);

        return view('backend.users.show', compact('user'));
    }

    public function create(){
        return view('backend.users.create');
    }

    public function store(Request $request){

        $content = $request ->validate([
            'role'=>'required',
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required'
        ]);

        $content['password'] = Hash::make($request->password);

        //不懂
        $user = new User();
        $user->fill($content);
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('backend-users.show',$user->id)->with('notice','會員新增成功!');
    }


    public function edit($id){
        $users = User::find($id);

        return view('backend.users.edit',['users'=>$users]);
    }

    public function update(Request $request,$id){
        $users = User::find($id);

        $content = $request ->validate([
            'role'=>'required',
            'name'=>'required',
            'email'=>'required'
        ]);

        $users->update($content);

        return redirect()->route('backend-users.show',$users->id)->with('notice','會員資料儲存成功!');
    }
}
