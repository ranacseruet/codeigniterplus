<form action="{$action_url}" method="POST" class="well col-md-6">
    <div class="form-group">
        <label class="control-label" for="{$message_form.name.field}">{$message_form.name.label}</label>
        <input type="text" name="{$message_form.name.field}" value="{$message->getName()}" class="required form-control" size="30"  />
    </div>
    <div class="form-group">
        <label class="control-label" for="{$message_form.email.field}">{$message_form.email.label}</label>
        <input type="text" name="{$message_form.email.field}" value="{$message->getEmail()}" class=" form-control required" size="30"  />
    </div>
    <div class="form-group">
        <label class="control-label" for="{$message_form.subject.field}">{$message_form.subject.label}</label>
        <input type="text" name="{$message_form.subject.field}" value="{$message->getSubject()}" class="form-control required" size="30"  />
    </div>
    <div class="form-group">
        <label class="control-label" for="{$message_form.message.field}">{$message_form.message.label}</label>
        <textarea name="{$message_form.message.field}" class="form-control required" size="30">
            {$message->getMessage()}
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-success" />&nbsp;<a class="btn btn-info pull-right" href="{$base_url}admin/message">Back to message list</a> 
    </div>
</form>