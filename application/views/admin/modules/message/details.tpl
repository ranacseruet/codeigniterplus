<form action="{$action_url}" method="POST" class="well">
    <div class="row-fluid">
        <label class="control-label" for="{$message_form.name.field}">{$message_form.name.label}</label><br/>
        <input type="text" name="{$message_form.name.field}" value="{$message->getName()}" class="required" size="30"  />
    </div>
    <div class="row-fluid">
        <label class="control-label" for="{$message_form.email.field}">{$message_form.email.label}</label><br/>
        <input type="text" name="{$message_form.email.field}" value="{$message->getEmail()}" class="required" size="30"  />
    </div>
    <div class="row-fluid">
        <label class="control-label" for="{$message_form.subject.field}">{$message_form.subject.label}</label><br/>
        <input type="text" name="{$message_form.subject.field}" value="{$message->getSubject()}" class="required" size="30"  />
    </div>
    <div class="row-fluid">
        <label class="control-label" for="{$message_form.message.field}">{$message_form.message.label}</label><br/>
        <input type="text" name="{$message_form.message.field}" value="{$message->getMessage()}" class="required" size="30"  />
    </div>
    <div class="row-fluid">
        <input type="submit" name="submit" value="Save" class="btn btn-success" />&nbsp;<a class="btn btn-info pull-right" href="{$base_url}admin/message">Back to message list</a> 
    </div>
</form>