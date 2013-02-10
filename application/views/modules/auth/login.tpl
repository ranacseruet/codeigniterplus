<fieldset>
	<legend>Login</legend>

        <form action="{$action_url}" method="post">
            <div class="row">
                <label class="control-label" for="username">Username</label>
                <input type="text" name="username" value="" id="username" size="30"  />
            </div>
                    
            <div class="row">
            	<label class="control-label" for="password">Password</label>
                <input type="password" name="password" value="" id="password" size="30"  />
            </div>

            <div class="row">
                <input type="checkbox" name="remember" value="1" id="remember" /> <label class="control-label" for="remember">Remember me</label>
                <a href="{$base_url}{$forgot_password_uri}">Forgot password</a> | 
                {if $allow_registration}
                <a href="{$base_url}{$register_uri}">Register</a>
                {/if}
            </div>

            <div class="row">
                <input type="submit" name="login" value="Login" class="btn"  />
            </div>
    </form>
</fieldset>
