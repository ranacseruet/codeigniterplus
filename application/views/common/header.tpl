<div id="header">
    <div class="span-24 last logo">    
        <h1>Welcome to CodeIgniterPlus!</h1>
    </div>
    <div class="span-24 last" id="main_menu">
        <ul>
            <li><a href="{$base_url}">Home</a></li>
            <li><a href="{$base_url}contact">Contact</a></li>
            {if !$is_logged_in}
            <li><a href="{$base_url}login">Login</a></li>
            <li><a href="{$base_url}register">Register</a></li>
            {else}
            <li><a href="{$base_url}myaccount/logout">Logout</a></li>
            <li><a href="{$base_url}myaccount">Dashboard</a></li>
            {/if}            
        </ul>
    </div>
    <div class="clear"></div>    
</div>