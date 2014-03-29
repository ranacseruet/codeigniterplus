<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Get domain
 *
 * Return the domain name only based on the "base_url" item from your config file.
 *
 * @access    public
 * @return    string
 */
if ( ! function_exists('get_domain'))
{
    function get_domain()
    {
        $CI =& get_instance();
        return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $CI->config->slash_item('base_url'));
    }
}

/* Get Facebook username From Facebook URL
 *
 * @access    public
 * @return    string
 */
if ( ! function_exists('get_facebook_username'))
{
    function get_facebook_username($facebook_url)
    {
        $matches = array();
        preg_match('#https?\://(?:www\.)?facebook\.com/(\d+|[A-Za-z0-9\.]+)/?#',$facebook_url,$matches);
        if($matches && is_array($matches)){
            return $matches[count($matches)-1];
        }
        else{
            return "";
        }
        //return base_url()."skills/". strtolower($skill->getUrl());
    }
}
