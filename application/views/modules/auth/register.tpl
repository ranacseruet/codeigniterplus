
<div class="col-md-6">
    <form action="{$action_url}" method="post" class="well">
        <fieldset>
            <legend>Register</legend>
            <div class="form-group">
                <label class="" for="username">Username</label>
                <input type="text" name="username" value="" id="username" size="30" class=" form-control required"  />
            </div>
            <div class="form-group">
                <label class="" for="password">Password</label>
                <input type="password" name="password" value="" id="password" size="30"  class="form-control required"  />
            </div>
            <div class="form-group">
                <label class="" for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" value="" id="confirm_password" size="30"  class="form-control required"  />
           </div>
           <div class="form-group">
                <label class="" for="email">Email Address</label>
                <input type="text" name="email" value="" id="email" maxlength="80" size="30"  class="form-control required email"  /><br/>
           </div> 
           <input type="submit" name="register" value="Register" class="btn btn-success"  />
        </fieldset>
    </form>
</div>
<div class="col-md-6 text-center">
    <br/><br/><br/><br/><br/><br/>
    <a href="{$base_url}login/Facebook" class="">
        <img src="{$base_url}images/sign_up_fb.png" alt="Facebook Login" />
    </a>
    <br/><br/>
    <a href="{$base_url}login/Twitter" class="">
        <img src="{$base_url}images/sign_up_tw.png" alt="Twitter Login" />
    </a>
</div>   

