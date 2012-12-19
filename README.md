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
	* Blue Print CSS (http://www.blueprintcss.org/)

- Javascript Libraries
       * Jquery (http://jquery.com/)
       * Google map API (https://developers.google.com/maps/)
       * Steal.js from JavascriptMVC (http://javascriptmvc.com/)
       * jQuery Validate Plugin(http://bassistance.de/jquery-plugins/jquery-plugin-validation/)

Features
----------
- A number of popular open source libraries to boost codeigniter development with your existing knowledge on them.(See above)
- Organized directory structure for view files/stylesheets and javascript files.
- Load javascripts libraries in asynchronous request, helping your application get the maximum performance.
- Load stylesheet files/javascript files automatically if exist for a specific page. No external include/import required.
- detect domain name automatically and add to the page title. Of course option also available for add page title/meta key and 
meta descriptions as well.
- custom on load function for your page, where you can initialize page specific tasks.
- Use ORM(doctrine) for database layer.
- User template engine(smarty) for view layer.
- Automatic client validation binding for forms all over the application(using jquery validate plugin). Also, custom enhanced style 
  applied to validation error message placeholder.


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

