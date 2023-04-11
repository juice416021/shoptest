
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '{your-app-id}',
            cookie     : true,
            xfbml      : true,
            version    : '{api-version}'
        });

        FB.AppEvents.logPageView();

        // Move the getLoginStatus call inside the fbAsyncInit function
        // FB.getLoginStatus(function(response) {
        //     statusChangeCallback(response);
        //
        // });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }
</script>


<x-guest-layout>
    <x-jet-authentication-card>


        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="信箱" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="密碼" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <br>
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.recaptcha_site_key')}}"></div>



{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="flex items-center">--}}
{{--                    <x-jet-checkbox id="remember_me" name="remember" />--}}
{{--                    <span class="ml-2 text-sm text-gray-600">記住我</span>--}}
{{--                </label>--}}
{{--            </div>--}}



            <div class="flex items-center justify-end mt-4">

{{--                <div class="fb-login-button " data-width="" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"--}}
{{--                     data-scope="public_profile,email" data-onlogin="checkLoginState();">--}}
{{--                        用FB帳號登入--}}
{{--                </div>--}}
                <a href="{{route('FbLogin')}}">Facebook登入</a>


                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        忘記密碼
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    登入
                </x-jet-button>
            </div>
        </form>






    </x-jet-authentication-card>
</x-guest-layout>


{{--<script type="text/javascript">--}}
{{--    var onloadCallback = function() {--}}
{{--        alert("grecaptcha is ready!");--}}
{{--    };--}}
{{--</script>--}}

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>

<script>

</script>
