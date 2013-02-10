<div class="navbar-inner">
    <div class="container">     
        <a class="brand" href="{$base_url}"><img src="#" width="111" height="30" alt="CodeigniterPlus" /></a>
        <div class="nav-collapse">
            <ul class="nav">
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
    </div>
</div>