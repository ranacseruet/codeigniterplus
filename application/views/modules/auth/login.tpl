<div class="row">
    <div class="col-md-6">
        <form action="{$action_url}" method="post"  class="well">
            <fieldset>
                <legend>Login</legend>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="" class="required form-control" size="30"  />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="" class="required form-control" size="30"  />
                </div>
                
                <label for="remember">
                    <input type="checkbox" name="remember" value="1" id="remember" /> 
                    Remember me <br/>
                    <a href="{$base_url}{$forgot_password_uri}">Forgot password</a>
                    {if $allow_registration}
                    | <a href="{$base_url}{$register_uri}">Register</a>
                    {/if}
                </label>
                <br/>
                <input class="btn btn-success" type="submit" name="login" value="Login"  />
            </fieldset>           
        </form>
    </div>
    <div class="col-md-6 text-center">
        <br/><br/><br/><br/><br/><br/>
        <a href="{$base_url}login/Facebook" class="">
            <img src="{$base_url}images/sign_in_fb.png" alt="Facebook Login" />
        </a>
        <br/><br/>
        <a href="{$base_url}login/Twitter" class="">
            <img src="{$base_url}images/sign_in_tw.png" alt="Twitter Login" />
        </a>
    </div>            
</div>        

