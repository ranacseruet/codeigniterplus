{if $status AND isset($status->success) AND isset($status->message)}
    <div id="status" class="status alert {if $status->success}alert-success{else}alert-error{/if}">
        {$status->message}
    </div>
{else}
    <div id="status" class="status">&nbsp;</div>
{/if}
<div class="clear"></div>
