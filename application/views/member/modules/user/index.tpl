Welcome back, {$user}

{if $is_logged_in AND $is_admin}
    <br>
    To Manage, Please Go To <a href="{$base_url}admin">Administration Area</a>
{/if}