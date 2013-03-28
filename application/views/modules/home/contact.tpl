<script language="text/javascript" type="text/javascript" src="{$base_url}scripts/modules/home/contact.js"></script>

    <div class="span4" id="error">
        <form name="contact" method="post" action="{$base_url}home/contact" id="contact" class="well">            
            <fieldset>
                <legend>Contact</legend> 
                <label class="control-label" for="name">{$contact_form.name.label} :</label>
                <input type="text" name="{$contact_form.name.field}" id="name" class="required">

                <label class="control-label" for="email">{$contact_form.email.label} :</label>
                <input type="text" name="{$contact_form.email.field}" id="email" class="required email">

                <label class="control-label" for="subject">{$contact_form.subject.label} :</label>
                <input type="text" name="{$contact_form.subject.field}" id="subject" class="required">

                <label class="control-label" for="message">{$contact_form.message.label} :</label>
                <textarea name="{$contact_form.message.field}" id="message" cols="45" rows="3" class="required"></textarea>

                <input type="submit" name="submit" id="submit" value="Submit" class="btn">
            </fieldset>
        </form>
    </div>

