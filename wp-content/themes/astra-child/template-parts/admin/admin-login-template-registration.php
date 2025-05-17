<div class="registration-form-wrapper">
    <form class="wp-form registration-form" id="registration-form">
        <div class="wp-form-tab active show" data-toggle="tab" id="step-1">
            <div class="wp-form-row">
                <div class="wp-form-group">
                    <p>Welcome to Singapore Ancestry.</p>
                </div>
            </div>
            <div class="wp-form-row wp-row-fields">
                <div class="wp-form-group">
                    <label>What is your name?</label>
                    <input type="text" class="input-control" name="reg_fullname" id="reg-fullname"/>
                </div>
            </div>
            <div class="wp-form-row">
                <div class="wp-form-group">
                    <button type="button" class="btn btn-submit" id="btn-next-step"><span>Next</span></button>
					<div class="error"></div>
                </div>
            </div>
        </div>
        <div class="wp-form-tab" data-toggle="tab" id="step-2">
            <div class="wp-form-row">
                <div class="wp-form-group">
                    <button type="button" class="btn btn-return"><i class="fa fa-chevron-left" aria-hidden="true"></i><span>Back</span></button>
                </div>
            </div>
            <div class="wp-form-row">
                <div class="wp-form-group">
                    <p>Hi <span id="display-reg-fullname"></span>, welcome to Singapore Ancestry.</p>
                </div>
            </div>
            <div class="wp-form-row wp-row-fields">
                <div class="wp-form-group">
                    <label>Email Address</label>
                    <input type="email" class="input-control" name="reg_email" id="reg-email"/>
                </div>
                <div class="wp-form-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" class="input-control" name="reg_password" id="reg-password"/>
                        <button type="button" class="show-password"><span class="d-none">Show Password</span><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <div class="wp-form-row wp-row-submit">
                <div class="wp-form-group">
                    <button type="submit" class="btn btn-solid btn-submit" id="btn-submit-register"><span>Register</span></button>
                    <div class="error"></div>
                </div>
            </div>
        </div>
    </form>
</div>
<button type="button" class="btn btn-text btn-template" data-method="default"><span>Already have an account?</span></button>