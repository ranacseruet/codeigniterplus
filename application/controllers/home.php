<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader                $load
* @property CI_Form_validation       $form_validation
* @property CI_Input                 $input
* @property CI_Email                 $email
* @property Usermodel                $usermodel
* @property Doctrine                 $doctrine
* @property Geoip                    $geoip
* @property Homemodel                $homemodel
* @property Countrymodel             $countrymodel
* @property Messagemodel             $messagemodel
* @property Mapper                   $mapper
* @property \Doctrine\ORM\EntityManager $em                
*/

class Home extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("messagemodel");
        $this->load->language("message");
    }
     
    /**
     * Default function that will be executed unless another method secified
     * @return type View
     */
    public function index()
    {   
        return $this->view();             
    }
    
    /**
     * Is called when a 404 server error occurs
     * @return type View
     */
    public function error()
    {        
        return $this->view();
    }
    
    
    /**
     * Controller For 'Contact Page'
     * @return type View
     */
    public function contact()
    {
        try
        {
            $forms = $this->config->item("rules");
            $data["contact_form"] = $forms["contact"];

            if($this->input->post('submit')){
                
                $this->load->library("app/formvalidator");    
                $this->load->library("app/mapper");
                
                if($this->formvalidator->isValid("contact")){
                    
                    $message = $this->mapper->formToMessage($this->input,$data["contact_form"],null);
                    $this->messagemodel->save($message);
                    
                    $data["status"]->message = $this->lang->line("message_sent");
                    $data["status"]->success = TRUE;
                }
                else{
                    $data["status"]->message = validation_errors();
                    $data["status"]->success = FALSE;
                }
            }

            return $this->view($data);
        }
        catch(Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    function generate_schema(){
        $this->em = $this->doctrine->em;
        
        $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);
        
        
        $cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
        $cmf->setEntityManager($this->em);
        $metadata = $cmf->getAllMetadata();
        
        $queries = $tool->getCreateSchemaSql($metadata);
        
        echo "Total queries: ".count($queries)."<br /><br />";
        for($i=0; $i<count($queries);$i++){
            $this->db->query($queries[$i]);
            echo $queries[$i]."<br /><br />Execution Successfull: ".($i+1)."<br /><br />";
        }
    }

}
/* End of file home.php */
/* Location: ./application/controllers/home.php */
