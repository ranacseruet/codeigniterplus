<div class="span12">
    <form action="{$action_url}" method="post">
        <fieldset>
            <legend>Register</legend>
            <label class="control-label" for="username">Username</label>
            <input type="text" name="username" value="" id="username" size="30" class="required"  />
            <label class="control-label" for="password">Password</label>
            <input type="password" name="password" value="" id="password" size="30"  class="required"  />
            <label class="control-label" for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" value="" id="confirm_password" size="30"  class="required"  />
            <label class="control-label" for="email">Email Address</label>
            <input type="text" name="email" value="" id="email" maxlength="80" size="30"  class="required email"  /><br/>
            <input type="submit" name="register" value="Register" class="btn"  />
        </fieldset>
    </form>
</div>
