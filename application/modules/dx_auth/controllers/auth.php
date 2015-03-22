<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	// Used for registering and changing password form validation
	var $min_username = 4;
	var $max_username = 20;
	var $min_password = 4;
	var $max_password = 20;

	/**
	 * @var DX_Auth $dx_auth
	 */
	var $dx_auth = null;

	function __construct()
	{
		//for overwrite the default prefix
		$this->prefix = "DX_";

		parent::__construct();

		$this->load->library('Form_validation');
		$this->load->library('DX_Auth');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->mysmarty->assign('action_url', "");
	}

	function index()
	{
		$this->login();
	}

	/* Callback function */

	function username_check($username)
	{
		$result = $this->dx_auth->is_username_available($username);
		if (!$result) {
			$this->form_validation->set_message('username_check', 'Username already exist. Please choose another username.');
		}

		return $result;
	}

	function email_check($email)
	{
		$result = $this->dx_auth->is_email_available($email);
		if (!$result) {
			$this->form_validation->set_message('email_check', 'Email is already used by another user. Please choose another email address.');
		}

		return $result;
	}

	function captcha_check($code)
	{
		$result = TRUE;

		if ($this->dx_auth->is_captcha_expired()) {
			// Will replace this error msg with $lang
			$this->form_validation->set_message('captcha_check', 'Your confirmation code has expired. Please try again.');
			$result = FALSE;
		} elseif (!$this->dx_auth->is_captcha_match($code)) {
			$this->form_validation->set_message('captcha_check', 'Your confirmation code does not match the one in the image. Try again.');
			$result = FALSE;
		}

		return $result;
	}

	function recaptcha_check()
	{
		$result = $this->dx_auth->is_recaptcha_match();
		if (!$result) {
			$this->form_validation->set_message('recaptcha_check', 'Your confirmation code does not match the one in the image. Try again.');
		}

		return $result;
	}

	/* End of Callback function */

	function login()
	{
		if (!$this->dx_auth->is_logged_in()) {
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('username', 'Username', 'trim|required|xss_clean');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean');
			$val->set_rules('remember', 'Remember me', 'integer');

			// Set captcha rules if login attempts exceed max attempts in config
			if ($this->dx_auth->is_max_login_attempts_exceeded()) {
				//$val->set_rules('captcha', 'Confirmation Code', 'trim|required|xss_clean|callback_captcha_check');
			}

			if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember'))) {
				// Redirect to homepage
				redirect('', 'location');
			} else {
				// Check if the user is failed logged in because user is banned user or not
				if ($this->dx_auth->is_banned()) {
					// Redirect to banned uri
					$this->dx_auth->deny_access('banned');
				} else {
					// Default is we don't show captcha until max login attempts eceeded
					$this->data['show_captcha'] = FALSE;

					// Show captcha if login attempts exceed max attempts in config
					if ($this->dx_auth->is_max_login_attempts_exceeded()) {
						// Create catpcha						
						//$this->dx_auth->captcha();
						// Set view data to show captcha on view file
						//$this->data['show_captcha'] = TRUE;
					}

					$this->data['forgot_password_uri'] = $this->dx_auth->forgot_password_uri;
					$this->data['register_uri'] = $this->dx_auth->register_uri;
					$this->data['allow_registration'] = $this->dx_auth->allow_registration;
					if ($this->dx_auth->get_auth_error()) {
						$this->data['status']->message = $this->dx_auth->get_auth_error();
						$this->data['status']->success = FALSE;
					}
					//$this->mysmarty->assign('captcha_error',form_error('captcha'));					
					return $this->view();
					;
				}
			}
		} else {
			$this->data['auth_message'] = 'You are already logged in.';
			$this->load->view($this->dx_auth->logged_in_view, $this->data);
		}
	}

	function logout()
	{
		$this->dx_auth->logout();

		//$this->data['auth_message'] = 'You have been logged out.';		
		//$this->load->view($this->dx_auth->logout_view, $data);
	}

	function register()
	{
		if (!$this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration) {
			$val = $this->form_validation;

			// Set form validation rules			
			$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[' . $this->min_username . ']|max_length[' . $this->max_username . ']|callback_username_check|alpha_dash');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');

			if ($this->dx_auth->captcha_registration) {
				$val->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback_captcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'))) {
				$this->data['status']->success = TRUE;

				// Set success message accordingly
				if ($this->dx_auth->email_activation) {
					$this->data['status']->message = 'You have successfully registered. Check your email address to activate your account.';
				} else {
					$this->data['status']->message = 'You have successfully registered. ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
				}

				$this->mysmarty->assign('confirm_password_error', form_error('confirm_password'));
				$this->mysmarty->assign('email_error', form_error('email'));
				$this->mysmarty->assign('show_captcha', FALSE);

				// Load registration success page
				return $this->view();
			} else {
				// Is registration using captcha
				if ($this->dx_auth->captcha_registration) {
					$this->dx_auth->captcha();
				}

				// Load registration page
				$this->data['status']->message = validation_errors();
				if ($this->data['status']->message) {
					$this->data['status']->success = FALSE;
				}
				return $this->view();
			}
		} elseif (!$this->dx_auth->allow_registration) {
			$this->data['status']->success = FALSE;
			$this->data['auth_message'] = 'Registration has been disabled.';
			$this->load->view($this->dx_auth->logged_in_view, $this->data);
		} else {
			$this->data['status']->success = FALSE;
			$this->data['auth_message'] = 'You have to logout first, before registering.';
			$this->load->view($this->dx_auth->logged_in_view, $this->data);
		}
	}

	function register_recaptcha()
	{
		if (!$this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration) {
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[' . $this->min_username . ']|max_length[' . $this->max_username . ']|callback_username_check|alpha_dash');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');

			// Is registration using captcha
			if ($this->dx_auth->captcha_registration) {
				// Set recaptcha rules.
				// IMPORTANT: Do not change 'recaptcha_response_field' because it's used by reCAPTCHA API,
				// This is because the limitation of reCAPTCHA, not DX Auth library
				$val->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback_recaptcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'))) {
				// Set success message accordingly
				if ($this->dx_auth->email_activation) {
					$this->data['auth_message'] = 'You have successfully registered. Check your email address to activate your account.';
				} else {
					$this->data['auth_message'] = 'You have successfully registered. ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
				}

				// Load registration success page
				$this->load->view($this->dx_auth->register_success_view, $data);
			} else {
				// Load registration page
				$this->load->view('auth/register_recaptcha_form');
			}
		} elseif (!$this->dx_auth->allow_registration) {
			$this->data['auth_message'] = 'Registration has been disabled.';
			$this->load->view($this->dx_auth->register_disabled_view, $this->data);
		} else {
			$this->data['auth_message'] = 'You have to logout first, before registering.';
			$this->load->view($this->dx_auth->logged_in_view, $this->data);
		}
	}

	function activate()
	{
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Activate user
		if ($this->dx_auth->activate($username, $key)) {
			$this->data['auth_message'] = 'Your account have been successfully activated. ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
			$this->load->view($this->dx_auth->activate_success_view, $data);
		} else {
			$this->data['auth_message'] = 'The activation code you entered was incorrect. Please check your email again.';
			$this->load->view($this->dx_auth->activate_failed_view, $data);
		}
	}

	function forgot_password()
	{
		if ($this->input->post("reset")) {
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('login', 'Username or Email address', 'trim|required|xss_clean');


			// Validate rules and call forgot password function
			if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('login'))) {
				$this->data['status']->success = TRUE;
				$this->data['status']->message = 'An email has been sent to your email with instructions with how to activate your new password.';
			} else {
				$this->data['status']->success = FALSE;
				$this->data['status']->message = "Couldn't find email or password. Please try again";
			}

			return $this->view();
		}
		return $this->view();
	}

	function reset_password()
	{
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Reset password
		if ($this->dx_auth->reset_password($username, $key)) {
			$this->data['auth_message'] = 'You have successfully reset you password, ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
			$this->load->view($this->dx_auth->reset_password_success_view, $data);
		} else {
			$this->data['auth_message'] = 'Reset failed. Your username and key are incorrect. Please check your email again and follow the instructions.';
			$this->load->view($this->dx_auth->reset_password_failed_view, $data);
		}
	}

	function change_password()
	{
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in()) {
			$val = $this->form_validation;

			// Set form validation
			$val->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
			$val->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_new_password]');
			$val->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean');

			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password'))) {
				$this->data['auth_message'] = 'Your password has successfully been changed.';
				$this->load->view($this->dx_auth->change_password_success_view, $data);
			} else {
				$this->load->view($this->dx_auth->change_password_view);
			}
		} else {
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	function cancel_account()
	{
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in()) {
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('password', 'Password', "trim|required|xss_clean");

			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password'))) {
				// Redirect to homepage
				redirect('', 'location');
			} else {
				$this->load->view($this->dx_auth->cancel_account_view);
			}
		} else {
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	// Example how to get permissions you set permission in /backend/custom_permissions/
	function custom_permissions()
	{
		if ($this->dx_auth->is_logged_in()) {
			echo 'My role: ' . $this->dx_auth->get_role_name() . '<br/>';
			echo 'My permission: <br/>';

			if ($this->dx_auth->get_permission_value('edit') != NULL AND $this->dx_auth->get_permission_value('edit')) {
				echo 'Edit is allowed';
			} else {
				echo 'Edit is not allowed';
			}

			echo '<br/>';

			if ($this->dx_auth->get_permission_value('delete') != NULL AND $this->dx_auth->get_permission_value('delete')) {
				echo 'Delete is allowed';
			} else {
				echo 'Delete is not allowed';
			}
		}
	}

	/**
	 * Login with social media sites
	 * @todo Need to check whether registration email and facebook email are same, otherwise
	 * send activation email instead of auto activation. Also need to test whether it is working ok.
	 * @param string $provider Social auth provider
	 */
	function hauth($provider)
	{
		try {
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
			$this->load->library('HybridAuthLib');
			$this->load->model("usersmodel");
			$this->load->model("user_temp");

			$user = new DxUsers();

			if ($this->hybridauthlib->providerEnabled($provider)) {

				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");

				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected()) {

					log_message('debug', 'controller.HAuth.login: user authenticated.');
					$providerSession = $this->hybridauthlib->getSessionData();
					$user_profile = $service->getUserProfile();
					if ($this->dx_auth->social_login($user_profile->identifier, $provider)) {
						$user = $this->usersmodel->get_user_by_social_id($user_profile->identifier, $provider);
						$user = set_social_session($user, $providerSession, $provider);
						$this->usersmodel->save($user);
						// Redirect to homepage
						redirect('', 'location');
						exit;
					} else {
						$user = $this->usersmodel->get_user_by_email($user_profile->email);

						if ($user) {
							//If user exist by email, just upda the facebook info and log user in

							$user = set_social_id($user, $user_profile->identifier, $provider);
							$user = set_social_session($user, $providerSession, $provider);
							$this->usersmodel->save($user);
							//echo "DB: ".$user->getFbId()." . API: ".$user_profile->identifier;exit;
							if ($this->dx_auth->social_login($user_profile->identifier, $provider)) {

								// Redirect to homepage
								redirect('', 'location');
								exit;
							} else {
								log_message("error", "couldn't login user");
							}
						} else {
							log_message("debug", "couldn't found user, need to register");
							$user = new DxUsers();
						}
					}
					// echo $this->input->post("register");
					if ($this->input->post("register")) {
						$val = $this->form_validation;

						// Set form validation rules
						$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[' . $this->min_username . ']|max_length[' . $this->max_username . ']|callback_username_check|alpha_dash');
						$val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
						$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
						// Run form validation and register user if it's pass the validation
						if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'))) {

							//activate user
							$temp_user = $this->user_temp->get_user_by_email($val->set_value('email'));

							if (!$this->config->item('DX_email_activation') || $this->dx_auth->activate($temp_user->getUserName(), $temp_user->getActivationKey())) {
								//set facebook auth info
								$user = $this->usersmodel->get_user_by_email($val->set_value('email'));
								$user = set_social_id($user, $user_profile->identifier, $provider);
								$user = set_social_session($user, $providerSession, $provider);

								$this->usersmodel->save($user);

								if ($this->dx_auth->social_login(get_social_id($user, $provider), $provider)) {
									// Redirect to homepage
									redirect('', 'location');
									exit;
								} else {
									$this->data["status"]->message = "Login Error. Please contact administrator for help";
									$this->data["status"]->success = FALSE;
								}
							}
						} else {
							$this->data["status"]->message = $this->dx_auth->_auth_error . validation_errors();
							$this->data["status"]->success = FALSE;
						}
					}

					log_message('info', 'controllers.HAuth.login: user profile:' . PHP_EOL . print_r($user_profile, TRUE));


					$this->data['show_captcha'] = FALSE;
					//$this->data['action_url'] = base_url()."register";

					$user->setEmail($user_profile->email);
					$user->setUsername(get_social_username($user_profile->profileURL, $provider));
					$this->data['user'] = $user;

					return $this->view();
				} else { // Cannot authenticate user
					show_error('Cannot authenticate user');
				}
			} else { // This service is not enabled.
				show_404($_SERVER['REQUEST_URI']);
			}
		} catch (Exception $e) {
			$error = 'Unexpected error';
			//handle_error($e);
			//echo $e->getMessage();exit;
			log_message('error', 'controllers.HAuth.login: ' . $error);
			show_error('Error authenticating user.');
		}
	}

	/**
	 * Hybrid authentication endpoint
	 */
	public function endpoint()
	{
		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: ' . print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		//require_once APPPATH.'/third_party/hybridauth/index.php';
		Hybrid_Endpoint::process();
	}
}