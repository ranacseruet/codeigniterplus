<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_form_validation
 *
 * @author mdaliahsanrana
 */
class MY_Form_validation extends CI_Form_validation {

	//put your code here
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Is a Valid phone number
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function phone_number($value)
	{
		$value = trim($value);
		if ($value == '') {
			return TRUE;
		} else {
			//Need to tweak as it only validates bangladeshi TNT phone numbers
			if (preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{2}[-. ]?[0-9]{7}$/', $value)) {
				return preg_replace('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/', '($1) $2-$3', $value);
			} else {
				return FALSE;
			}
		}
	}

	/**
	 * Is a Valid Website Url
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function valid_url($value)
	{
		//Need to make more accurate;
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)(:[0-9]+)?(/.*)?$|i', $value) ? TRUE : FALSE;
	}
}