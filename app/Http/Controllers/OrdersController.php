<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \ECPay_PaymentMethod as ECPayMethod;
use ECPay_AllInOne as ECPay;
use Illuminate\Support\Facades\Log;
class OrdersController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show','callback']);
    }
    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        $quantity = $request->validate([
            'quantity' => 'required'
        ])['quantity'];

        if (!$product) {
            return redirect()->back()->with('notice', '商品不存在');
        }

        //如果用戶登入 就用資料庫存購物車
        if (Auth::check()) {
            $userId = Auth::id();
            $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
            if ($cartItem) {
                // 如果已經包含，就增加數量
                $cartItem->quantity += $quantity;
                //如果超過庫存 就變成庫存數
                $cartItem->quantity=min($cartItem->quantity,$product->quantity);
            } else {
                // 如果不包含，新增商品到購物車中
                $cartItem = new Cart([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
            $cartItem->save();
        }

//        else{
//            // 從 Session 中取得購物車內容
//            $cart = $request->session()->get('cart', []);
//            $cart = collect($cart);
//
//            if ($cart->has($productId)) {
//                $item = $cart->get($productId);
//                $item['quantity'] += $quantity;
//                // 如果超過庫存，將數量設定為庫存數
//                $item['quantity'] = min($item['quantity'], $item['product']->quantity);
//            } else {
//                $item = [
//                    'product' => $product,
//                    'quantity' => $quantity,
//                ];
//            }
//
//            $item['subtotal'] = $item['product']->price * $item['quantity'];
//            $cart->put($productId, $item);
//
//            $total = $cart->reduce(function ($carry, $item) {
//                return $carry + $item['subtotal'];
//            }, 0);
//
//            $request->session()->put([
//                'cart' => $cart->toArray(),
//                'total' => $total,
//            ]);
//        }

        return redirect()->back()->with('notice', '已加入'.$quantity.'個'.$product->name.'到購物車');
    }

//    public function cart()
//    {
//        //因為此時的session是一個 PHP 陣列而不是 Laravel 的集合（Collection）物件。因此，您不能在 $cartItems 上調用 Laravel 的集合方法，例如 isEmpty()。
//        //所以這裡才用collect把session包起來
//
//        // 檢查使用者是否已經登入
//        if (Auth::check()) {
//            // 取得使用者 ID
//            $userId = Auth::id();
//            // 從資料庫中取得使用者的購物車內容
//            $cartItems = Cart::where('user_id', $userId)->get();
//        } else {
//            // 從 session 中取得購物車內容
//            $cartItems = session('cart');
//        }
//        $cartItems=(session('cart'));
//        $total=(session('total'));
//
//        return view('orders.cart',['cartItems'=>$cartItems,'total'=>$total]);
//    }
    public function cart()
    {
        $user = auth()->user();

        if ($user) {
            // 如果有登入，從資料庫取得購物車內容
            $cartItems = $user->carts()->get();
            $total = 0;
            // 將每個商品的價格更新為當前商品的價格
            foreach ($cartItems as $item) {
                $product = Product::find($item->product_id);
                $item->product->price = $product->price;
                $total=$total+$item->product->price*$item->quantity;
            }

        }
//        else {
//            // 如果沒有登入，從 Session 取得購物車內容
//            $cartItems = collect(session('cart'));
//            $total = 0;
//
//            // 將每個商品的價格更新為當前商品的價格
//            foreach ($cartItems as &$item) {
//                $product = Product::find($item['product']->id);
//                $item['product']->name = $product->name;
//                $item['product']->price = $product->price;
//                $item['subtotal'] = $product->price * $item['quantity'];
//                $total += $item['subtotal'];
//            }
//
//            // 將更新後的購物車內容存回 Session
//            session(['cart' => $cartItems, 'total' => $total]);
//        }


        return view('orders.cart', ['cartItems' => $cartItems, 'total' => $total]);
    }



    public function checkout()
    {
//        $cart = session('cart', []);
//        $total = session('total', 0);
//        $orderNumber = bin2hex(random_bytes(8));
//
//
//        $order = auth()->user()->orders()->create([
//            'order_number' => $orderNumber,
//            'total_amount' => $total,
//        ]);
//
//        //這裡有點看不懂
//        //如果商品被刪除 到時候利用productId找資料會找不到 可能需要存商品名稱以及其他資訊
//        foreach ($cart as $productId => $item) {
//            $order->products()->attach($productId, [
//                'quantity' => $item['quantity'],
//                'price' => $item['product']->price,
//            ]);
//        }


//        session()->forget('cart');
//        session()->forget('total');
//        //這裡要提早save 因為等等會跑CheckOut()去其他頁面 所以session不會被刪 需要馬上save才會forget
//        session()->save();

        $user = auth()->user();
        $cartItems = $user->carts()->with('product')->get();
        $orderNumber = bin2hex(random_bytes(8));

        $total = 0;
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            $total=$total+$item->product->price*$item->quantity;
        }

        $order = $user->orders()->create([
            'order_number' => $orderNumber,
            'total_amount' => $total,
        ]);

        foreach ($cartItems as $cartItem) {
            $order->products()->attach($cartItem->product_id, [
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }






        //以下是綠界金流串接
        include(app_path('ECPaySDK/ECPay.Payment.Integration.php'));

        try {
            $obj=new ECPay();

//            //服務參數
//            $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";   //服務位置
//            $obj->HashKey     = 'pwFHCqoQZGmho4w6' ;                                           //測試用Hashkey，請自行帶入ECPay提供的HashKey
//            $obj->HashIV      = 'EkRm7iFT261dpevs' ;                                           //測試用HashIV，請自行帶入ECPay提供的HashIV
//            $obj->MerchantID  = '3002607';                                                     //測試用MerchantID，請自行帶入ECPay提供的MerchantID
//            $obj->EncryptType = '1';                                                           //CheckMacValue加密類型，請固定填入1，使用SHA256加密
            //服務參數
            $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";   //服務位置
            $obj->HashKey     = '5294y06JbISpM5x9' ;                                           //測試用Hashkey，請自行帶入ECPay提供的HashKey
            $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                           //測試用HashIV，請自行帶入ECPay提供的HashIV
            $obj->MerchantID  = '2000132';                                                     //測試用MerchantID，請自行帶入ECPay提供的MerchantID
            $obj->EncryptType = '1';                                                           //CheckMacValue加密類型，請固定填入1，使用SHA256加密


            //基本參數(請依系統規劃自行調整)
            $MerchantTradeNo = "Test".time() ;
            $obj->Send['ReturnURL']         = "https://ce5c-1-161-211-97.ngrok-free.app/callback" ;    //付款完成通知回傳的網址
            $obj->Send['PeriodReturnURL']         = "https://ce5c-1-161-211-97.ngrok-free.app/callback" ;    //付款完成通知回傳的網址
            $obj->Send['ClientBackURL']         = "https://ce5c-1-161-211-97.ngrok-free.app/success" ;    //返回商店的網址
            $obj->Send['MerchantTradeNo']   = $orderNumber;                          //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                       //交易時間
            $obj->Send['TotalAmount']       = $total;                                      //交易金額
            $obj->Send['TradeDesc']         = "good to drink" ;                          //交易描述
            $obj->Send['ChoosePayment']     = \ECPay_PaymentMethod::Credit ;              //付款方式:Credit
            $obj->Send['IgnorePayment']     = \ECPay_PaymentMethod::GooglePay ;           //不使用付款方式:GooglePay

            //訂單的商品資料
            foreach ($cartItems as $item) {
                array_push($obj->Send['Items'], [
                    'Name' => $item['product']->name,
                    'Price' => $item['product']->price,
                    'Currency' => "元",
                    'Quantity' => $item['quantity'],
                    'URL' => "商品 URL"
                ]);
            }

            //Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
            //以下參數不可以跟信用卡定期定額參數一起設定
            $obj->SendExtend['CreditInstallment'] = '' ;    //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24

            $obj->SendExtend['Redeem'] = false ;           //是否使用紅利折抵，預設false
            $obj->SendExtend['UnionPay'] = false;          //是否為聯營卡，預設false;

            //Credit信用卡定期定額付款延伸參數(可依系統需求選擇是否代入)
            //以下參數不可以跟信用卡分期付款參數一起設定
            // $obj->SendExtend['PeriodAmount'] = '' ;    //每次授權金額，預設空字串
            // $obj->SendExtend['PeriodType']   = '' ;    //週期種類，預設空字串
            // $obj->SendExtend['Frequency']    = '' ;    //執行頻率，預設空字串
            // $obj->SendExtend['ExecTimes']    = '' ;    //執行次數，預設空字串

            # 電子發票參數
            /*
            $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
            $obj->SendExtend['RelateNumber'] = "Test".time();
            $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
            $obj->SendExtend['CustomerPhone'] = '0911222333';
            $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
            $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
            $obj->SendExtend['InvoiceItems'] = array();
            // 將商品加入電子發票商品列表陣列
            foreach ($obj->Send['Items'] as $info)
            {
                array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                    $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
            }
            $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
            $obj->SendExtend['DelayDay'] = '0';
            $obj->SendExtend['InvType'] = ECPay_InvType::General;
            */

            //產生訂單(auto submit至ECPay)
            $obj->CheckOut();
        } catch (Exception $e) {
            echo $e->getMessage();
        }


        return redirect()->route('products.Page');
    }

    public function callback(Request $request)
    {
        DB::beginTransaction();
        $order = Order::where('order_number', $request->MerchantTradeNo)->firstOrFail();

        try {
            //把訂單改成已付款
            $order->is_paid = 1;
            $order->save();
            //找到使用者 刪除購物車資料
            $user = User::find($order->user_id);
            $user->carts()->delete();
            //更新商品庫存
            $order->updateProductStock();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response('0|' . $e->getMessage());
        }


        // 返回成功響應（根據綠界的要求）
        return response('1|OK');
    }
    public function redirectFromECpay(Request $request)
    {
        return redirect()->route('orders.history');
    }

    public function history(Request $request)
    {
        $user = auth()->user();
        $orders = $user->orders()->with('products')->orderByDesc('created_at');

        $keyword = $request->input('keyword', null);
        $isPaid = $request->input('is_paid', null);
        $startDate = $request->input('start_date', null);
        $endDate = $request->input('end_date', null);
        $sort = $request->input('sort', 'desc'); //預設以日期新到舊排序




        if (! is_null($keyword)) {
            $orders = $orders->where(function ($query) use ($keyword) {
                $query->where('order_number', 'like', "%{$keyword}%")
                    ->orWhereHas('products', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        if (! is_null($isPaid)) {
            $orders = $orders->where('is_paid', $isPaid);
        }

        if (! is_null($startDate)) {
            $orders = $orders->whereDate('created_at', '>=', $startDate);
        }

        if (! is_null($endDate)) {
            $orders = $orders->whereDate('created_at', '<=', $endDate);
        }


        $orders = $orders->paginate(10);

        return view('orders.history', compact('orders', 'keyword', 'isPaid', 'startDate', 'endDate'));
    }



    //清空購物車
    public function clearCart(Request $request)
    {
        //清空購物車
        $user = auth()->user();
        $user->carts()->delete();

        return redirect()->back();
    }


}


