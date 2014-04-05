<div class="row-fluid">
    <div class="span6">
        <form action="{$action_url}" method="post"  class="well">
            <fieldset>
                <legend>Login</legend>
                <label for="username">Username</label>
                <input type="text" name="username" value="" class="required" size="30"  />
                <label for="password">Password</label>
                <input type="password" name="password" value="" class="required" size="30"  />

                <label for="remember">
                    <input type="checkbox" name="remember" value="1" id="remember" /> 
                    Remember me
                    <a href="{$base_url}{$forgot_password_uri}">Forgot password</a>
                    {if $allow_registration}
                    <a href="{$base_url}{$register_uri}">Register</a>
                    {/if}
                </label>
                <input class="btn" type="submit" name="login" value="Login"  />
            </fieldset>           
        </form>
    </div>
    <div class="span6 text-center">
        <br/><br/><br/><br/><br/><br/>
        <a href="{$base_url}login/Facebook" class="btn btn-success">Login With Facebook</a>
        <br/><br/>
        <a href="{$base_url}login/Twitter" class="btn btn-success">Login With twitter</a>
    </div>            
</div>        

