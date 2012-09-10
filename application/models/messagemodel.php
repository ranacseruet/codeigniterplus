<?php
require_once(APPPATH."models/Entities/PdContact.php");

use \PdContact;


/**
 * City model
 * @final Messagemodel
 * @category model
 * @author Rana
 */
class Messagemodel extends My_DModel{
    //put your code here


    function __construct() {
        parent::__construct();
        $this->init("PdContact",$this->doctrine->em);
    }
}