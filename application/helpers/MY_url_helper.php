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
if ( ! function_exists('get_social_username'))
{
    function get_social_username($profile_url,$provider)
    {
        $matches    =   array();
        $username   =   "";
       
        switch ($provider) {
            case 'Facebook':
                preg_match('#https?\://(?:www\.)?facebook\.com/(\d+|[A-Za-z0-9\.]+)/?#',$profile_url,$matches);
                if($matches && is_array($matches)){
                    $username   =   $matches[count($matches)-1];
                }
                else{
                    $username   =   "";
                }
                break;
            
            case 'Twitter':
                preg_match('#https?\://(?:www\.)?twitter.com/(\d+|[A-Za-z0-9\.]+)/?#',$profile_url,$matches);
                if($matches && is_array($matches)){
                    $username   =   $matches[count($matches)-1];
                }
                else{
                    $username   =   "";
                }
                break;
            
            default:
                break;
        }
        return $username;
    }
}

/* Set criteria by socail id
 *
 * @access    public
 * @return    string
 */
if ( ! function_exists('set_criteria_by_social_id'))
{
    function set_criteria_by_social_id($social_id,$provider)
    {
        $criteria   =   array();
        switch ($provider) {
            case 'Facebook':
                $criteria   =   array('fbId'=>$social_id);
                break;
            
            case 'Twitter':
                $criteria   =   array('twitterId'=>$social_id);
                break;
            
            default:
                break;
        }
        return $criteria;
    }
}

/* set user socialsession field
 *
 * @access    public
 * @return    string
 */
if ( ! function_exists('set_social_session'))
{
    function set_social_session($user,$providerSession,$provider)
    {
        
        switch ($provider) {
            case 'Facebook':
                $user   =   $user->setFbSession($providerSession);
                break;
            
            case 'Twitter':
                $user   =   $user->setTwitterSession($providerSession);
                break;
            
            default:
                break;
        }
        return $user;
    }
}

/* set user socialid field
 *
 * @access    public
 * @return    string
 */
if ( ! function_exists('set_social_id'))
{
    function set_social_id($user,$socialId,$provider)
    {
        
        switch ($provider) {
            case 'Facebook':
                $user   =   $user->setFbId($socialId);
                break;
            
            case 'Twitter':
                $user   =   $user->setTwitterId($socialId);
                break;
            
            default:
                break;
        }
        return $user;
    }
}


/* set user socialid field
 *
 * @access    public
 * @return    string
 */
if ( ! function_exists('get_social_id'))
{
    function get_social_id($user,$provider)
    {
        
        switch ($provider) {
            case 'Facebook':
                $user_social_id   =   $user->getFbId();
                break;
            
            case 'Twitter':
                $user_social_id   =   $user->getTwitterId();
                break;
            
            default:
                break;
        }
        return $user_social_id;
    }
}