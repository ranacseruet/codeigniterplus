<?php
use \PdMessage;

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
        $this->init("PdMessage",$this->doctrine->em);
    }
}