<script language="text/javascript" type="text/javascript" src="{$base_url}scripts/modules/home/contact.js"></script>

    <div class="col-md-12 well" id="error">
        <form name="contact" method="post" action="{$base_url}home/contact" id="contact" class=" col-md-6">            
            <fieldset>
                <legend>Contact</legend> 
                <div class="form-group">
                    <label class="" for="name">{$contact_form.name.label} :</label>
                    <input type="text" name="{$contact_form.name.field}" id="name" class="required form-control">
                </div>
                <div class="form-group">
                    <label class="" for="email">{$contact_form.email.label} :</label>
                    <input type="text" name="{$contact_form.email.field}" id="email" class="required email form-control">
                </div>
                <div class="form-group">
                    <label class="" for="subject">{$contact_form.subject.label} :</label>
                    <input type="text" name="{$contact_form.subject.field}" id="subject" class="required form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="message">{$contact_form.message.label} :</label>
                    <textarea name="{$contact_form.message.field}" id="message" cols="45" rows="3" class="required form-control"></textarea>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
            </fieldset>
        </form>
    </div>

