<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader            $load
* @property CI_Form_validation   $form_validation
* @property CI_Input             $input
* @property CI_Email             $email
* @property Mysmarty             $mysmarty
* @property Doctrine             $doctrine
* @property Usermodel            $usermodel
* @property DxUsers              $cuser
* @property DxUserProfile        $user_profile
* @property Citymodel            $citymodel
* @property Countrymodel         $countrymodel
* @property Expertisemodel       $expertisemodel
* @property Userlib              $userlib   
* @property Formvalidator        $formvalidator   
* @property Uri                  $url   
*/

class User extends User_Controller
{
    
     
    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();                               
        $this->load->model("usermodel");        
        $this->user_id = $this->dx_auth->get_user_id();
    }
    
    /**
     * Default function that will be executed unless another method secified
     */
    public function index()
    {
        try
        {
            //Info of currently logged in user is succefully retrieved
            $this->data["user"] = $this->dx_auth->get_username();


            return $this->view();
        }
        catch (Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    
    
}

/* End of file user.php */
/* Location: ./application/controllers/dashboard.php */
