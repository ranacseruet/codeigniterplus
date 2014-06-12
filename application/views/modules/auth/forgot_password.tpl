<fieldset>
    <legend>Forgotten Password</legend>
    <form action="{$base_url}forgot_password" method="post" accept-charset="utf-8"  class="well">
        <div>
            <label for="login" class="control-label">Enter your Username or Email Address</label>
            <input type="text" class="" name="login" value="" id="login" maxlength="80" size="30"  /> 		
        </div>
        <div>
            <input type="submit" name="reset" value="Reset Now" class="btn btn-success"  />
        </div>
    </form>
</fieldset>