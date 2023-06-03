{{-- @extends('layout')
@section('loginRegister') --}}



            <div id="login-body" class="m-5">
                <h2>Login</h2>
                <form method="POST" enctype="multipart/form-data" class="d-flex flex-column" action="{{route('doLogin')}}">

                    {{ csrf_field() }}

                    <label for="email">email&nbsp;<span style="color: red;">*&nbsp;&nbsp;</span></label>
                    @error('email')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <input value="
                    @if (!empty(old('email')))
                        {{old('email')}}
                    @elseif (!empty($cookieData))
                        {{$cookieData}}
                    @endif
                    " type="email" name="email"
                        class="form-input" required="">

                    <label for="password">password&nbsp;<span style="color: red;">*&nbsp;&nbsp;</span><span
                            class="show-password float-end">show &nbsp;<i class="fas fa-eye"></i></span></label>
                    @error('password')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <input type="password" name="password" class="form-input" required="">


                    <div>
                        <input style="width: fit-content" id="form-remember-me" type="checkbox" name="remember"
                            class="form-input">
                        <label for="form-remember-me">remember me&nbsp;</label>
                    </div>


                    @if (session('status') == 'ok')
                        <p class="mt-4" style="color: var(--success-font)">
                            {{ session('msg') }}</p>
                    @elseif (session('status') == 'fail' or $errors->any())
                        <p style="color: var(--fail-font)" class="mt-4">
                            {{ session('msg') ? session('msg') : 'Inputs need to pass validation' }}&nbsp;<i
                                class="fas fa-times-circle"></i>
                        </p>
                    @endif

                    {{-- <p id="SUCCESS-login" class="mt-4" style="display: none; color: var(--success-font)">SUCCESS LOGIN</p>
                <p id="email_not_registered" class="mt-4" style="display: none; color: var(--fail-font)">Email Not Registered...</p>
                <p id="wrong_password" class="mt-4" style="display: none; color: var(--fail-font)">Incorrect Password...</p>
                <p id="no-data" class="mt-4" style="display: none; color: var(--fail-font)">Input Must Be Filled</p> --}}
                <div class="d-inline-flex align-items-center justify-content-center mt-5">
                    <i class="fa-solid fa-ellipsis fa-beat-fade fa-2xl fs-1" style="display: none"></i>
                </div>
                <div class="d-inline-flex align-items-center justify-content-between mt-4">
                    <button type="button" id="login-submit" class="button me-2" style="width: 50%;">Login&nbsp;&nbsp;<div class="fa-2x"><i
                                class="fas fa-circle-notch fa-spin"></i></div></button>
                    <button type="button" class="button clear-input-action" style="width: 50%; background: var(--red-accent)">Clear
                        Inputs</button>
                </div>
                <p class="mt-4">Do not have account yet? | <span id="toRegisterFromLogin"
                        style="color:var(--link-font); cursor:pointer">Register</span> </p>
                </form>
            </div>


    <script>
        $(document).ready(() => {
            $('#login-body > form #login-submit').click(function() {
                // e.preventDefault()
                console.log("ffffffffffff")

                let form = document.querySelector('#login-body > form');

                // Create a new FormData object and pass the form element
                let formData = new FormData(form);

                // Retrieve a specific value by key
                let email = formData.get('email');
                let password = formData.get('password');
                let remember = formData.get('remember') === 'on';
                let csrf = formData.get('_token');

                console.log(email)

                let jsonData = {
                    email: email,
                    password: password,
                    remember: remember
                    // _token: csrf
                };
                
                $.ajax({
                    url: "{{route('loginApi')}}",
                    method: 'POST',
                    // headers: {
                    //     'X-CSRF-TOKEN': csrf
                    // },
                    data: JSON.stringify(jsonData),
                    contentType: 'application/json',
                    timeout: 5000,
                    success: function (response) {
                        console.log(response)
                        // $(this).off('submit');
                        $('#login-body > form').submit();
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 401) {
                            pushToastMessage(error, 'fail to authenticate', 'fail')
                        }else if(xhr.status === 500) {
                            pushToastMessage('failed', 'fail to request to the server', 'fail')
                        }else{
                            pushToastMessage(error, error, 'info')
                        }
                    },
                    beforeSend: function () {
                        // animateProgressBar(true)

                        $('#login-body .fa-ellipsis').show();
                    },
                    complete: function () {
                        // $('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
                        // $('.progress-bar').addClass('opacity-0')
                        // $('.progress-bar').removeClass('opacity-100')

                        $('#login-body .fa-ellipsis').hide();
                    },
                });

            })
        })
    </script>
{{-- @endsection --}}