Codeigniterplus (The Ultimate Codeigniter Enhancements)
=====================================

Codeigniterplus is an super light-weight codeigniter based extension with various other third party libraries. This will help developers
to have a kick-ass start along their way to web application development.
	
Libraries used:
------------------
- PHP libraries
	* DX_Auth (https://github.com/EllisLab/CodeIgniter/wiki/DX-Auth)
	* Hybridauth (social login library: http://hybridauth.sourceforge.net/)
	* Doctrine (http://www.doctrine-project.org/)
	* Smarty (http://www.smarty.net/)
	* HMVC (https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc) 


- Stylesheet
	* Blue Print Css

- Javascript Libraries
       * Jquery
       * Goggle map
       * Steal from JavascriptMVC

Installation
----------
- Crate a new project with your chosen name. 
- Paste all file from Codeigniterplus to your project directory.
- Change 'RewriteBase' on '.htaccess' file as per your your chosen name. If using root level domain, just remove it and keep as 'RewriteBase /'. 
- Crate a database with your given database name in config/database.php file.
- Now edit config/database.php file; Here change the database server, database name, user name and password as per your database server.
- Run http://{domain_path}/home/db_schema for create database tables from the doctrine entities, automatically.
  (Note :Every time when you update your entity file in models/entity directory just Run the above url for update existing schema.)
- run the application, register with username 'admin'. This will cause to create default two roles 'admin' and user automatically and will 
  make user 'admin' in 'admin' role. From this on, whenever a registration happens, all will be assigned default 'user' role.
  (Note: If you wish to change this functionality please do so on 'application/libraries/DX_Auth.php', starting at line 930.)

Basic functionality
-------------------

You will get default functionality and diretory/file structure built in for three different section.
        * Front end, or publicly viewable pages.
        * User end, when registered members can login and have their accessible functionality.
        * Admin end, to perform administration functionality. You have your freedom to add as much as you want :).

