<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * contains utility functions related to User
 *
 * @author Rana
 */
class Userlib {

	function __construct()
	{
		$this->ci = & get_instance();
	}

	/**
	 * Mapp user submitted inputs to entity object of User's basic profile
	 * @param type $form
	 * @param type $user
	 * @return type 
	 */
	public function mappFormToUserProfile($user_profile_form, $input, $user_profile = NULL)
	{
		if (empty($user_profile)) {
			$user_profile = new DxUserProfile();
		}
		$user_profile->setFirstName($input->post($user_profile_form["first_name"]["field"]));
		$user_profile->setLastName($input->post($user_profile_form["last_name"]["field"]));
		$user_profile->setAbout($input->post($user_profile_form["about"]["field"]));
		$user_profile->setAddress1($input->post($user_profile_form["address1"]["field"]));
		$user_profile->setAddress2($input->post($user_profile_form["address2"]["field"]));
		$user_profile->setZipCode($input->post($user_profile_form["zip_code"]["field"]));
		$user_profile->setWebsite($input->post($user_profile_form["website"]["field"]));
		$user_profile->setPhoneNumber($input->post($user_profile_form["phone"]["field"]));

		$city = $this->ci->citymodel->get_city_by_name($input->post($user_profile_form["city"]["field"]));

		if (empty($city)) {
			$country = $this->ci->countrymodel->get_by_code($input->post($user_profile_form["country"]["field"]));
			$city = new GdCities();
			$city->setCountry($country);
			$city->setName($input->post($user_profile_form["city"]["field"]));
			$this->ci->citymodel->save($city);
		}
		$user_profile->setUser($this->ci->usermodel->get($input->post("user_id")));
		$user_profile->setCityId($city->getId());

		return $user_profile;
	}

	/**
	 * Initialize the pagination rules for members page 
	 * @return Pagination
	 */
	public function initPagination($city, $start_record)
	{
		$config['per_page'] = 1;
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url() . "/browse/members/" . $city;
		$config['total_rows'] = $this->ci->usermodel->get_count_by_city_id($city);
		$this->ci->pagination->initialize($config);
		return $config;
	}
}