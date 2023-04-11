<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;



            $requestArr=$request->except('_method', '_token');;
            $validator=Validator::make($requestArr, [
                'g-recaptcha-response' => function ($attribute, $value, $fail) use ($requestArr) {
                    $secretkey = config('services.recaptcha.recaptcha_secret_key');
                    $response = $value;
                    $userIP = $_SERVER['REMOTE_ADDR'];
                    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$userIP";
                    $response = \file_get_contents($url);
                    $response = json_decode($response);
                    if(!$response->success){
                        $fail('請點擊我不是機器人');
                    }
                }
            ]);
            //下面這個很重要 不能刪 否則上面的function會不跑
            $validator->validate();

            //這段程式碼是在使用 Laravel 框架中的「throttle（限流）」中間件來限制某個請求來源（IP地址和電子郵件地址）在每分鐘內最多只能發送 5 個請求。
            //Limit::perMinute(5) 創建一個每分鐘只允許五次請求的限制。 by($email.$request->ip()) 指定限制器使用請求的 IP 地址和電子郵件地址作為識別符，這樣每個不同的 IP 和電子郵件地址都可以獨立計數。
            return Limit::perMinute(5)->by($email.$request->ip());
        });




        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }

}
