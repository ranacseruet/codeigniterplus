<fieldset>
	<legend>Register</legend>
    <form action="{$action_url}" method="post">
        <div class="row">
            <div class="label"><label for="username">Username</label></div>
            <div class="input"><input type="text" name="username" value="" id="username" size="30"  /></div>
        </div>
        <div class="row">
        	<div class="label"><label for="password">Password</label></div>
            <div class="input"><input type="password" name="password" value="" id="password" size="30"  /></div>
        </div>
        <div class="row">
        	<div class="label"><label for="confirm_password">Confirm Password</label></div>
            <div class="input"> <input type="password" name="confirm_password" value="" id="confirm_password" size="30"  />{$confirm_password_error}</div>
        </div>
        <div class="row">
        	<div class="label"><label for="email">Email Address</label></div>
            <div class="input"><input type="text" name="email" value="" id="email" maxlength="80" size="30"  />{$email_error}</div>
        </div>
        {if $show_captcha}
        <div class="row">
        	<div class="label">Enter the code exactly as it appears. There is no zero.</div>
            <div class="input">{$captcha_image}</div>
        </div>
        <div class="row">
        	<div class="label"><label for="captcha">Confirmation Code</label></div>
            <div class="input"><input type="text" name="captcha" value="" id="captcha"  />{$captcha_error}</div>
        </div>
        {/if}
        <div class="row">
        	<div class="label"></div>
            <div class="input"><input type="submit" name="register" value="Register"  /></div>
        </div>
    </form>
</fieldset>