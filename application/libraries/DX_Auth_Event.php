<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Event for DX_Auth
// You can use DX_Auth_Event to extend DX_Auth to fullfil your needs
// For example: you can use event below to PM user when he already activated the account, etc.
class DX_Auth_Event {

	var $ci;

	function __construct()
	{
		$this->ci = & get_instance();
	}

	// If DX_email_activation in config is TRUE, 
	// this event occurs after user succesfully activated using specified key in their email.
	// If DX_email_activation in config is FALSE, 
	// this event occurs right after user succesfully registered.	
	function user_activated($user_id)
	{
		// Load models
		$this->ci->load->model('dx_auth/user_profile', 'user_profile');
		$this->ci->load->model('dx_auth/usersmodel', 'user');

		// Create user profile
		//$this->ci->user_profile->create_profile($user_id);
	}

	// This event occurs right after user login
	function user_logged_in($user_id)
	{
		
	}

	// This event occurs right before user logout
	function user_logging_out($user_id)
	{
		
	}

	// This event occurs right after user change password
	function user_changed_password($user_id, $new_password)
	{
		
	}

	// This event occurs right before user account is canceled
	function user_canceling_account($user_id)
	{
		// Load models
		$this->ci->load->model('dx_auth/user_profile', 'user_profile');

		// Delete user profile
		$this->ci->user_profile->delete_profile($user_id);
	}

	// This event occurs when check_uri_permissions() function in DX_Auth is called
	// after checking if user role is allowed or not to access URI, this event will be triggered
	// $allowed is result of the check before, it's possible to alter the value since it's passed by reference
	function checked_uri_permissions($user_id, &$allowed)
	{
		
	}

	// This event occurs when get_permission_value() function in DX_Auth is called	
	function got_permission_value($user_id, $key)
	{
		
	}

	// This event occurs when get_permissions_value() function in DX_Auth is called	
	function got_permissions_value($user_id, $key)
	{
		
	}

	// This event occurs right before dx auth send email with account details
	// $data is an array, containing username, password, email and last ip
	// $content is email content, passed by reference	
	// You can customize email content here
	function sending_account_email($data, &$content)
	{
		// Load helper
		$this->ci->load->helper('url');

		// Create content	
		$content = sprintf($this->ci->lang->line('auth_account_content'), $this->ci->config->item('DX_website_name'), $data['username'], $data['email'], $data['password'], site_url($this->ci->config->item('DX_login_uri')), $this->ci->config->item('DX_website_name'));
	}

	// This event occurs right before dx auth send activation email
	// $data is an array, containing username, password, email, last ip, activation_key, activate_url
	// $content is email content, passed by reference	
	// You can customize email content here
	function sending_activation_email($data, &$content)
	{
		// Create content
		$content = sprintf($this->ci->lang->line('auth_activate_content'), $this->ci->config->item('DX_website_name'), $data['activate_url'], $this->ci->config->item('DX_email_activation_expire') / 60 / 60, $data['username'], $data['email'], $data['password'], $this->ci->config->item('DX_website_name'));
	}

	// This event occurs right before dx auth send forgot password request email
	// $data is an array, containing password, key, and reset_password_uri
	// $content is email content, passed by reference	
	// You can customize email content here
	function sending_forgot_password_email($data, &$content)
	{
		// Create content
		$content = sprintf($this->ci->lang->line('auth_forgot_password_content'), $this->ci->config->item('DX_website_name'), $data['reset_password_uri'], $data['password'], $data['key'], $this->ci->config->item('DX_webmaster_email'), $this->ci->config->item('DX_website_name'));
	}
}