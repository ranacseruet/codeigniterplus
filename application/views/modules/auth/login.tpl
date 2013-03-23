<div class="span12">
    <form action="{$action_url}" method="post">
        <fieldset>
            <legend>Login</legend>
            <label class="control-label" for="username">Username</label>
            <input type="text" name="username" value="" id="username" size="30"  />
            <label class="control-label" for="password">Password</label>
            <input type="password" name="password" value="" id="password" size="30"  /> 
            <label class="checkbox" for="remember">
                <input type="checkbox" name="remember" value="1" id="remember" /> Remember me
            </label>
            <a href="{$base_url}{$forgot_password_uri}">Forgot password</a> | 
            {if $allow_registration}
                <a href="{$base_url}{$register_uri}">Register</a>
            {/if}
            <input type="submit" name="login" value="Login" class="btn"  />
        </fieldset>
    </form>
</div>

