<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mints Auth</title>

    {{-- BS --}}
    <link rel="stylesheet" href="{{ asset("bs/css/bootstrap.min.css") }}">
    <script src="{{ asset("bs/js/bootstrap.bundle.min.js")}}"></script>


    <link rel="stylesheet" href="{{ asset("css/auth/auth.css") }}">
</head>

<body>

    <main id="form-signin" class="w-100 m-auto">
        <form action="{{ route('login.post') }}" onsubmit="return handle_submit()" method="post">
            @csrf
            <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    
            <div class="form-floating mb-4">
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
<script src="{{ asset("js/app.js")}}"></script>

<script>
    const handle_submit = () => {
        const data = $('form').serialize();
        validate(data);
        return false;
    };

    const validate = (data) => {

        // clean error forms
        clean_error_forms();

        axios.post("{{ route('login.post') }}", data)
        .then( (response) => {
            const {status, data} = response;
            if ( status == 200 && data.success ) return window.location = "{{route('home')}}";
        })
        .catch( ({response}) => {
            const {status, data} = response;

            // errores de validacion del formulario
            if ( status == 422 && data.validator ) return show_error_form(data.validator);

            // Autenticación incorrecta
            if ( status == 422 && !data.success ) return swale(data.message, "", "ok");

            // error interno
            if ( status == 500 ) return swali("Ups", "estamos teniendo problemas internos, vuelve a intentar más tarde", "ok")
        })
    };

    const clean_error_forms = () => {
        $('form input').each( (i, input) => {
            $(input).removeClass('is-invalid is-valid');
            $(input).parent().find(`.invalid-feedback`).remove();
        })
    };

    const show_error_form = ( list_errors ) => {
        for (const error_key in list_errors) {
            if (Object.hasOwnProperty.call(list_errors, error_key)) {
                const error_msg = list_errors[error_key];
                const $error_input = $(`input#${error_key}`);
                if ( $error_input.length ) $error_input.addClass('is-invalid').parent().append( template_tag_error(error_msg) );
            }
        }
    };

    const template_tag_error = (message) => {
        return `<span class="invalid-feedback" role="alert">
            <strong>${message}</strong>
        </span>`
    };
</script>

</html>
