<div id="overlay-outter" class="d-flex position-fixed align-items-start">
    <div id="overlay-wrapper">

        <div id="xmark-button">
            <button class="float-end"><i class="fa-solid fa-xmark"></i></button>
        </div>


        <div id="login-body">
            <h2>Login to Your Account</h2>
            <form method="POST" enctype="multipart/form-data" class="d-flex flex-column">
                <label for="email">email&nbsp;<span style="color: red;">*&nbsp;&nbsp;</span></label>
                <input type="email" name="email" class="form-input" required="" value="">
                <label for="password">password&nbsp;<span style="color: red;">*&nbsp;&nbsp;</span><span class="show-password float-end">show &nbsp;<i class="fas fa-eye"></i></span></label>
                <input type="password" name="password" class="form-input" required="">


                <div>
                    <input style="width: fit-content" id="form-remember-me" type="checkbox" name="remember" class="form-input" required="">
                    <label for="form-remember-me">remember me&nbsp;</label>
                </div>




                <p id="SUCCESS-login" class="mt-4" style="display: none; color: var(--success-font)">SUCCESS LOGIN</p>
                <p id="email_not_registered" class="mt-4" style="display: none; color: var(--fail-font)">Email Not Registered...</p>
                <p id="wrong_password" class="mt-4" style="display: none; color: var(--fail-font)">Incorrect Password...</p>
                <p id="no-data" class="mt-4" style="display: none; color: var(--fail-font)">Input Must Be Filled</p>

                <div class="d-inline-flex align-items-center justify-content-between mt-4">
                    <button class="button me-2" id="login-action" style="width: 50%;">Login&nbsp;&nbsp;<div class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div></button>
                    <button class="button clear-input-action" style="width: 50%; background: var(--red-accent)">Clear Inputs</button>
                </div>
                <p id="" class="mt-4">Do not have account yet? | <span class="register-show" style="color:var(--link-font); cursor:pointer">Register</span> </p>
            </form>
        </div>
        <div id="register-body">
            <h2>Register</h2>
            <form enctype="multipart/form-data" class="d-flex flex-column">



                <label for="email">email<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                <input type="email" name="email" class="form-input" required="">

                <label for="username">username<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                <input type="text" name="username" class="form-input" required="">

                <label for="phone">phone<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                <input type="text" name="phone" class="form-input" required="">

                <label for="address">address<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                <textarea name="address" class="form-input" required="" rows="6" cols="50"></textarea>


                <label for="user_image64">profile picture &nbsp;<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                <input type="file" name="user_image64" placeholder="photo" required="">

                <label for="password">password<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span><span class="message"></span><span class="show-password float-end">show &nbsp;<i class="fas fa-eye"></i></span></label>
                <input type="password" name="password" class="form-input" required="">

                <label for="verify_pass">re-type password<span style="color: red;">&nbsp;*&nbsp;&nbsp;&nbsp;</span></label>
                <input type="password" name="verify_pass" class="form-input" required="">


                <p id="SUCCESS-regis" class="mt-4" style="display: none; color: var(--success-font)">SUCCESS REGISTER</p>
                <p id="username-already-exist" class="mt-4" style="display: none; color: var(--fail-font)">Username Already Exist...</p>
                <p id="unmatch-password" class="mt-4" style="display: none; color: var(--fail-font)">Password Does Not Match...</p>
                <p id="no-data" class="mt-4" style="display: none; color: var(--fail-font)">Input Must Be Filled</p>
                <p id="unmatch-pass-length" class="mt-4" style="display: none; color: var(--fail-font)">Password Too Short...</p>

                <div class="d-inline-flex align-items-center flex-wrap mt-4">


                    <div class="d-inline-flex align-items-center justify-content-between">
                        <button class="button me-2" id="register-action" style="width: 50%;">Register&nbsp;&nbsp;<div class="fa-2x"><i class="fas fa-circle-notch fa-spin"></i></div></button>
                        <button class="button clear-input-action me-2" style="width: 50%; background: var(--red-accent)">Clear Inputs</button>
                    </div>
                    <div>
                        <p>already have account?</p>
                        <p class="login-show" style="color:var(--link-font); cursor:pointer">Log In</p>
                    </div>
                </div>

            </form>
        </div>


    </div>
</div>
