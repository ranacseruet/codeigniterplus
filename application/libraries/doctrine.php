<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\ORM\Mapping\Driver\DatabaseDriver,
    Doctrine\ORM\Tools\DisconnectedClassMetadataFactory,
    Doctrine\ORM\Tools\EntityGenerator;

/**
 * CodeIgniter Doctrine Class
 *
 * initializes basic doctrine settings and act as doctrine object
 *
 * @final    Doctrine 
 * @category Libraries
 * @author   Md. Ali Ahsan Rana
 * @link     http://codesamplez.com/
 */
class Doctrine {

	/**
	 * @var EntityManager $em 
	 */
	public $em = null;

	/**
	 * constructor
	 */
	public function __construct()
	{
		// load database configuration from CodeIgniter
		require APPPATH . 'config/database.php';

		// Set up class loading. You could use different autoloaders, provided by your favorite framework,
		// if you want to.
		//require_once APPPATH.'third_party/Doctrine/Common/ClassLoader.php';

		$doctrineClassLoader = new ClassLoader('Doctrine', APPPATH . '../vendor/doctrine');
		$doctrineClassLoader->register();
		$entitiesClassLoader = new ClassLoader('models', APPPATH . "models/Entities");
		$entitiesClassLoader->register();

		$proxiesClassLoader = new ClassLoader('proxies', APPPATH . 'models/proxies');
		$proxiesClassLoader->register();

		// Set up caches
		$config = new Configuration;
		//TODO this approach won't work always, developers may habe memcached installed, but not interested
		//to use or server not running. Need to fix.
		if (class_exists('Memcached')) {
			$memcache = new \Memcached();
			$memcache->addServer('127.0.0.1', 11211);
			$cacheDriver = new \Doctrine\Common\Cache\MemcachedCache();
			$cacheDriver->setMemcached($memcache);
		} else if (extension_loaded('apc') && ini_get('apc.enabled')) {
			$cacheDriver = new \Doctrine\Common\Cache\ApcCache();
		} else {
			$cacheDriver = new \Doctrine\Common\Cache\ArrayCache();
		}

		$config->setMetadataCacheImpl($cacheDriver);
		$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH . 'models/Entities'));
		$config->setMetadataDriverImpl($driverImpl);
		$config->setQueryCacheImpl($cacheDriver);

		// Proxy configuration
		$config->setProxyDir(APPPATH . 'models/proxies');
		$config->setProxyNamespace('Proxies');

		// Set up logger
		//$logger = new Doctrine\DBAL\Logging\CIProfiler();
		//$config->setSQLLogger($logger);

		$config->setAutoGenerateProxyClasses(TRUE);
		// Database connection information
		$connectionOptions = array(
			'driver' => 'pdo_mysql',
			'user' => $db['default']['username'],
			'password' => $db['default']['password'],
			'host' => $db['default']['hostname'],
			'dbname' => $db['default']['database']
		);

		// Create EntityManager
		$this->em = EntityManager::create($connectionOptions, $config);

		foreach ($driverImpl->getAllClassNames() as $class) {
			require_once($entitiesClassLoader->getIncludePath() . "/" . $class . ".php");
		}
		//$this->generate_classes();
	}

	/**
	 * generate entity objects automatically from mysql db tables
	 * @return none
	 */
	function generate_classes()
	{
		$this->em->getConfiguration()
				->setMetadataDriverImpl(
						new DatabaseDriver(
						$this->em->getConnection()->getSchemaManager()
						)
		);

		$cmf = new DisconnectedClassMetadataFactory();
		$cmf->setEntityManager($this->em);
		$metadata = $cmf->getAllMetadata();
		$generator = new EntityGenerator();

		$generator->setUpdateEntityIfExists(true);
		$generator->setGenerateStubMethods(true);
		$generator->setGenerateAnnotations(true);
		$generator->generate($metadata, APPPATH . "models/Entities");
	}
}