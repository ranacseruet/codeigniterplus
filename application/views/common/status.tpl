{if $status}
    <div id="status" class="status {if $status->success}success{else}error{/if}">
        {$status->message}
    </div>
{else}
    <div id="status" class="status">&nbsp;</div>
{/if}
<div class="clear"></div>
