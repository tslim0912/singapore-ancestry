<?php admin_button_back('default'); ?>
<div class="login-form-wrapper">
    <form class="wp-form login-form" id="login-form">
        <div class="wp-form-row wp-row-fields">
            <div class="wp-form-group">
                <label>Username / Email Address <span class="required">*</span></label>
                <input type="text" class="input-control login-username" name="login_username" id="login-username"/>
            </div>
            <div class="wp-form-group">
                <label>Password <span class="required">*</span></label>
                <div class="password-wrapper">
                    <input type="password" class="input-control login-password" name="login_password" id="login-password"/>
                    <button type="button" class="show-password"><span class="d-none">Show Password</span><i class="fa fa-eye" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        <div class="wp-form-row wp-row-submit">
            <div class="wp-form-group">
                <button type="submit" class="btn btn-solid btn-submit btn-login" id="btn-login"><span>Login</span></button>
                <div class="error"></div>
            </div>
        </div>
    </form>
</div>