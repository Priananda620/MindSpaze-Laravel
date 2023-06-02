{{-- @extends('layout')
@section('loginRegister') --}}


            <div id="register-body" class="m-5">
                <h2>Register</h2>
                <form method="POST" enctype="multipart/form-data" class="d-flex flex-column" action="{{ url('/doRegister') }}">

                    {{ csrf_field() }}

                    <label for="username">Username<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                    @error('username')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <input value="{{ !empty(old('username')) ? old('username') : '' }}" type="text" name="username" class="form-input mb-3" required="" autocomplete="off">

                    <label for="email">Email<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                    @error('email')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <input value="{{ !empty(old('email')) ? old('email') : '' }}" type="email" name="email"
                        class="form-input mb-3" required="" autocomplete="off">


                    <label for="phone">Phone<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                    @error('phone')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <input value="{{ !empty(old('phone')) ? old('phone') : '' }}" type="text" name="phone"
                        class="form-input mb-3" required="" autocomplete="off">


                    <label for="address">address<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                    @error('address')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <textarea autocomplete="off" name="address" class="form-input mb-3" required="" rows="6" cols="50">{{ !empty(old('address')) ? old('address') : '' }}</textarea>


                    <label for="state"><span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span>Choose a state:</label>
                    <select id="state" name="state">

                        {{-- @forelse ($states as $object)
                            <option value="{{ $object->id }}">{{ $object->stateOf }}</option>
                        @empty
                            <option value="">--empty--</option>
                        @endforelse --}}


                    </select>

                    <label for="password">password<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span><span
                            class="message"></span><span class="show-password float-end">show &nbsp;<i
                                class="fas fa-eye"></i></span></label>
                    @error('password')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <input type="password" name="password" class="form-input mb-3" required="" autocomplete="off">


                    <label for="verPass">Retype Password<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span><span
                            class="message"></span><span class="show-password2 float-end">show &nbsp;<i
                                class="fas fa-eye"></i></span></label>
                    @error('verPass')
                        <div class="form_message"><strong>{{ $message }}</strong></div>
                    @enderror
                    <input type="password" name="verPass" class="form-input mb-3" required="" autocomplete="off">


                    @if (session('status') == 'ok')
                        <p class="mt-4" style="color: var(--success-font)">
                            {{ session('msg') }}</p>
                    @elseif (session('status') == 'fail' or $errors->any())
                        <p style="color: var(--fail-font)" class="mt-4">
                            {{ session('msg') ? session('msg') : 'Inputs need to pass validation' }}&nbsp;<i
                                class="fas fa-times-circle"></i>
                        </p>
                    @endif

                    {{-- <p id="username-already-exist" class="mt-4" style="display: none; color: var(--fail-font)">Username
                        Already Exist...</p>
                    <p id="unmatch-password" class="mt-4" style="display: none; color: var(--fail-font)">Password Does Not
                        Match...</p>
                    <p id="no-data" class="mt-4" style="display: none; color: var(--fail-font)">Input Must Be Filled</p>


                    <p id="unmatch-pass-length" class="mt-4" style="display: none; color: var(--fail-font)">Password Too
                        Short...</p> --}}

                    <div class="d-inline-flex align-items-center flex-wrap mt-4">


                        <div class="d-inline-flex align-items-center justify-content-between">
                            <button class="button me-2" id="register-action" style="width: 50%;">Register&nbsp;&nbsp;<div
                                    class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div></button>
                            <button class="button clear-input-action me-2"
                                style="width: 50%; background: var(--red-accent)">Clear Inputs</button>
                        </div>
                        <div>
                            <p>already have account?</p>
                            <p id="toLoginFromRegister" style="color:var(--link-font); cursor:pointer">Log In</p>
                        </div>
                    </div>

                </form>
            </div>




    {{-- <script>
        $(document).ready(() => {
            $('.register-show').click()
            console.log("dssadsd")

            $('#toLoginFromRegister').on('click', (e) => {
                window.location.href = "{{ url('login') }}"
            })
        })
    </script>
@endsection --}}
