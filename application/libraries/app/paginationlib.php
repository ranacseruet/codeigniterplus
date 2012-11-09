<?php
/**
     *Initialize the pagination rules for cities page 
     * @return Pagination
     */
class Paginationlib {
    //put your code here
    function __construct() {
         $this->ci =& get_instance();
    }

    public function initPagination($base_url,$total_rows){
        $config['per_page']          = 20;
        $config['uri_segment']       = 4;
        $config['base_url']          = base_url().$base_url;
        $config['total_rows']        = $total_rows;
        $this->ci->pagination->initialize($config);
        return $config;    
    }
    
}