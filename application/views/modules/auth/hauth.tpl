<form action="" method="post" class="well">
    <fieldset>
	<legend>We are almost done!</legend>
        <label for="email">{if $user->getEmail()}Review{else}Enter{/if} Your Email Address</label>
        <input type="text" name="" value="{$user->getEmail()}" id="email" maxlength="80" size="30" class="required email "   />
        <input type="hidden" name="email" id="user_email" value="{$user->getEmail()}" />
        <label for="username">{if $user->getUserName()}Review{else}Create An{/if} Username</label>
        <input type="text" name="username" value="{$user->getUserName()}" id="username" size="30" class="required"  />
        <label for="password">Create A Password</label>
        <input type="password" name="password" id="password" value="" size="30" class="required"  />
        <br />
        <input class="btn btn-success" type="submit" name="register" value="Create My Account"  />
    </fieldset>
</form> 