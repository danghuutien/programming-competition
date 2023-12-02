<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">{{--class="{{ $dark_mode ? 'dark' : '' }}"--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đăng nhập</title>
    <link href="{{asset('admin_assets/libs/css/tailwind.min.css?v='.config('Asset.vesion'))}}" rel="stylesheet">
    <link href="{{asset('admin_assets/build/css/app.min.css?v='.config('Asset.vesion'))}}" rel="stylesheet">
    <link href="{{asset('admin_assets/libs/css/app.min.css?v='.config('Asset.vesion'))}}" rel="stylesheet">
    <style>
		@php
			echo file_get_contents(asset('assets/fonts/Roboto/stylesheet.css?v='.config('Asset.vesion')));
		@endphp
	</style>

</head>

<body class="login" style="padding: 0px;">
    <style>
        .background-login {
            background-image: url("/images/bg-login.jpg");
            background-size: cover;
            background-repeat: round;
        }
        body{
            font-family: roboto;
        }
    </style>
    <div class="min-h-screen  flex justify-center items-center background-login">

        <div class="py-12 px-12 bg-white rounded-2xl shadow-xl z-20">
            <div>
                <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">ĐĂNG NHẬP HỆ THỐNG</h1>

            </div>
            <div class="space-y-4">
                <form id="login-form">
                    <input id="name" type="text" class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                        placeholder="Tên đăng nhập">
                    <div id="error-name" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                    <input id="password" type="password"
                        class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                        placeholder="Mật khẩu">
                    <div id="error-password" class="login__input-error w-5/6 text-theme-6 mt-2"></div>
                </form>
            </div>
            <div class="text-center mt-6">
                <button id="btn-login" class="py-3 w-64 text-xl text-white bg-purple-400 rounded-2xl">ĐĂNG NHẬP</button>

            </div>
        </div>

    </div>
    <script src="{{asset('admin_assets/libs/js/TweenLite.min.js?v='.config('Asset.vesion'))}}"></script>
    <script src="{{asset('admin_assets/libs/js/EasePack.min.js?v='.config('Asset.vesion'))}}"></script>
    <!-- <script src="./js/demo.js.download"></script> -->
    <script id="rendered-js"></script>

    <!-- BEGIN: JS Assets-->
    <script src="{{asset('admin_assets/libs/js/app.js?v='.config('Asset.vesion'))}}"></script>
    <!-- END: JS Assets-->
    <script>
        cash(function() {
            async function login() {
                // Reset state
                cash('#login-form').find('.login__input').removeClass('border-theme-6')
                cash('#login-form').find('.login__input-error').html('')

                // Post form
                let name = cash('#name').val()
                let password = cash('#password').val()
                let rememberMe = cash('#remember-me').val()

                // Loading state
                cash('#btn-login').html(
                    '<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                await helper.delay(1500)

                axios.post(`login`, {
                    name: name,
                    password: password,
                    remember_me: rememberMe
                }).then(res => {
                    location.href = '/admin'
                }).catch(err => {
                    cash('#btn-login').html('Login')
                    if (err.response.data.message != 'Tên đăng nhập hoặc mật khẩu sai') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            cash(`#${key}`).addClass('border-theme-6')
                            cash(`#error-${key}`).html(val)
                        }
                    } else {
                        cash(`#password`).addClass('border-theme-6')
                        cash(`#error-password`).html(err.response.data.message)
                    }
                })
            }

            cash('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })
            cash('#btn-login').on('click', function() {
                login()
            })
        })
    </script>
</body>

</html>