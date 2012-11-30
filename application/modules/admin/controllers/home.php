<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader                $load
* @property CI_Form_validation       $form_validation
* @property CI_Input                 $input
* @property CI_Email                 $email
* @property Mysmarty                 $mysmarty
* @property Doctrine                 $doctrine
* @property Geoip                    $geoip
* @property Homemodel                $homemodel
*/

class Home extends Admin_Controller
{
    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();        
        $this->load->model("usermodel");
    }
   
    
    
    /**
     * Default function that will be executed unless another method secified
     * @return type View
     */
    public function index()
    {   
        return $this->view();             
    }
   
}
/* End of file home.php */
/* Location: ./application/modules/controllers/home.php */