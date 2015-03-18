<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Composer
 *
 * @author Rana
 */
class MY_Composer {

	function __construct()
	{
		include("./vendor/autoload.php");
	}
}