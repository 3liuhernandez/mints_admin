
@php
    // handle url redirect after login success
    $url_redirect = $redirect ? route($redirect) : route('home');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - {{section()}}</title>

    {{-- BS --}}
    <link rel="stylesheet" href="{{ asset("bs/css/bootstrap.min.css") }}">
    <script src="{{ asset("bs/js/bootstrap.bundle.min.js")}}"></script>


    <link rel="stylesheet" href="{{ asset("css/auth/auth.css") }}">
</head>

<body>

    <main id="form-signin" class="w-100 m-auto">
        <form action="{{ route('login.post') }}" data-redirect="{{ $url_redirect }}" onsubmit="return handle_submit()" method="post">
            @csrf
            <img class="mb-4 d-block mx-auto" src="{{asset('images/home/logo.jpg')}}" alt="" width="92" height="77">
            <strong class="h3 mb-4 fw-normal">Please sign in</strong>
            <div class="form-floating mt-2 mb-4">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
    
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2023-2023</p>
        </form>
    </main>

</body>

<script src="{{ asset("js/axios.min.js")}}"></script>
<script src="{{ asset("js/jquery-3.6.0.min.js")}}"></script>
<script src="{{ asset("js/sweetalert.min.js")}}"></script>

{{-- BlockUI --}}
<script src="{{ asset('jquery_blockui/jquery.blockUI.js') }}"></script>
<link rel="stylesheet" href="{{ asset('jquery_blockui/nprogress.css') }}">
<script src="{{ asset('jquery_blockui/nprogress.min.js') }}"></script>

<script src="{{ asset("js/app.js")}}"></script>

<script>
    const handle_submit = () => {
        const data = $('form').serialize();
        validate(data);
        return false;
    };

    const validate = (data) => {

        blockui("");

        // clean error forms
        clear_error_forms($('form'));

        const url_login_validate = $('form').attr('action');
        const url_redirect = $('form').data('redirect');

        axios.post(url_login_validate, data)
        .then( (response) => {
            const {status, data} = response;
            if ( status == 200 && data.success ) return window.location = url_redirect;
        })
        .catch( ({response}) => {

            blockui_stop();

            const {status, data} = response;

            // errores de validacion del formulario
            if ( status == 422 && data.validator ) return show_error_form(data.validator);

            // Autenticación incorrecta
            if ( status == 422 && !data.success ) return swale(data.message, "", "ok");

            // error interno
            if ( status == 500 ) return swali("Ups", "estamos teniendo problemas internos, vuelve a intentar más tarde", "ok")
        })
    };
</script>

</html>
