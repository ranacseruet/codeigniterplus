<?php
$system_path = 'system';
$application_folder = 'application';
define('BASEPATH', str_replace("\\", "/", $system_path));
define('APPPATH', $application_folder.'/');
        
include __DIR__."/vendor/autoload.php";
include __DIR__."/application/libraries/doctrine.php";

$doctrine = new Doctrine();
$em = $doctrine->em;
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

return $helperSet;

