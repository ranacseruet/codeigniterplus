<script language="text/javascript" type="text/javascript" src="{$base_url}scripts/modules/home/contact.js"></script>
<div id="content">
</br>
    <div class="span-24 last" id="error">
        <form name="contact" method="post" action="{$base_url}home/contact" id="contact">            
             <div>
                 <label>{$contact_form.name.label} :</label><br />
                 <input type="text" name="{$contact_form.name.field}" id="name" class="required">
             </div>
             <div>
                 <label>{$contact_form.email.label} :</label><br />
                 <input type="text" name="{$contact_form.email.field}" id="email" class="required email">
             </div>
             <div>
                 <label>{$contact_form.subject.label} :</label><br />
                 <input type="text" name="{$contact_form.subject.field}" id="subject" class="required">
             </div>   
             <div>
                 <label>{$contact_form.message.label} :</label><br />
                 <textarea name="{$contact_form.message.field}" id="message" cols="45" rows="3" class="required"></textarea>
             </div>                  
             <input type="submit" name="submit" id="submit" value="Submit">
        </form>
    </div>
</div>
