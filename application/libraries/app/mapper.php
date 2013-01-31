<?php
use \PdContact;

/**
 * Description of mapper
 *
 * @author Rana
 */
class Mapper {
    //put your code here
    function __construct() {
         $this->ci =& get_instance();
    }
    
    function formToMessage($input,$contact_form,$contact=NULL){
        /**
         * @var PdContact $contact
         */
         if(empty($contact))
        {
            $contact = new PdMessage();
        }
       
        $contact->setName($input->post($contact_form["name"]["field"]));
        $contact->setEmail($input->post($contact_form["email"]["field"]));
        $contact->setSubject($input->post($contact_form["subject"]["field"]));
        $contact->setMessage($input->post($contact_form["message"]["field"]));
        $contact->setTime(new DateTime());
        return $contact;
    }
}
