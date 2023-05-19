{{-- @extends('layout')
@section('loginRegister') --}}



            <div id="login-body" class="m-5">
                <h2>Login For Tutor</h2>
                <form method="POST" enctype="multipart/form-data" class="d-flex flex-column" action="{{ url('/doLogin') }}">

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

                    <div class="d-inline-flex align-items-center justify-content-between mt-4">
                        <button class="button me-2" style="width: 50%;">Login&nbsp;&nbsp;<div class="fa-2x"><i
                                    class="fas fa-circle-notch fa-spin"></i></div></button>
                        <button class="button clear-input-action" style="width: 50%; background: var(--red-accent)">Clear
                            Inputs</button>
                    </div>
                    <p class="mt-4">Do not have account yet? | <span id="toRegisterFromLogin"
                            style="color:var(--link-font); cursor:pointer">Register</span> </p>
                </form>
            </div>


    {{-- <script>
        $(document).ready(() => {
            $('.login-show').click()
            console.log("dssadsd")

            $('#toRegisterFromLogin').on('click', (e) => {
                window.location.href = "{{ url('register') }}"
            })
        })
    </script> --}}
{{-- @endsection --}}