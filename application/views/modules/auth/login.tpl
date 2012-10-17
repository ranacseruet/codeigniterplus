<fieldset>
	<legend>Login</legend>

        <form action="{$action_url}" method="post">
            <div class="row">
                <div class="label"><label for="username">Username</label></div>
                <div class="input"><input type="text" name="username" value="" id="username" size="30"  /></div>
            </div>
                    
            <div class="row">
            	<div class="label"><label for="password">Password</label></div>
                <div class="input"><input type="password" name="password" value="" id="password" size="30"  /></div>
            </div>
                    
            {if $show_captcha}
            <div class="row">
            	<div class="label">Enter the code exactly as it appears. There is no zero.</div>
		<div class="input">{$captcha_image}</div>
            </div>

            <div class="row">
            	<div class="label"><label for="captcha">Confirmation Code</label></div>
		<div class="input"><input type="text" name="captcha" value="" id="captcha" maxlength="8"  />{$captcha_error}</div>
            </div>
            {/if}

            <div class="row">
            	<div class="label"></div>
                <div class="input">
                    <input type="checkbox" name="remember" value="1" id="remember" /> <label for="remember">Remember me</label>
                    <a href="{$base_url}{$forgot_password_uri}">Forgot password</a>
                    {if $allow_registration}
                    <a href="{$base_url}{$register_uri}">Register</a>
                    {/if}
        	</div>
            </div>

            <div class="row">
            	<div class="label"></div>
                <div class="input"><input type="submit" name="login" value="Login"  /></div>
            </div>
    </form>
</fieldset>
