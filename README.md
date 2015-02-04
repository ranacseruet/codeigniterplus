#Codeigniterplus 

[![Build Status](https://travis-ci.org/ranacseruet/codeigniterplus.svg)](https://travis-ci.org/ranacseruet/codeigniterplus)

Codeigniterplus is scaffolding for a good standard web application, built on the top of codeigniter framework and extended with various other third party frontend/backend libraries/techonlogies. 
This will help developers to have a kick-ass quick start along their way to better managed web application development.

See [Release Notes](https://github.com/ranacseruet/codeigniterplus/wiki/Release-Note)

See The [Complete List Of Libraries Used For This Project](https://github.com/ranacseruet/codeigniterplus/wiki/List-Of-Libraries-Used-Intergated)

[View Live Demo](http://demo.codesamplez.com/codeigniterplus/)

Technical Requirement
---------------------
- PHP version 5.3.x
- Mysql version 5.x+ Database Engine(Should work with other db as well which doctrine support. But I haven't tested yet)
- [Composer](http://getcomposer.org/) (to install and use third party libraries through it, which is highly recommended).
- [Bower](http://bower.io/) to install front-end any third party packages.

Basic Site functionality
-------------------
- Set up with modern dependency based PHP development standard.
- Set up with modern front end development stack(bower, bootstrap, jQuery).
- You will get ready made authentication functionality
- An organized integrated view template structure so that you don't get lost in a sea of view files.
- Separate view root for front-end/public pages and back-end/authenticated users' pages.
- Basic Administration panel, to perform administration functionality. You have your freedom to add as much as you want :).
- Integrated basic SEO settings, seo for pagination.

[See all available feature](https://github.com/ranacseruet/codeigniterplus/wiki/Feature-Details-Of-CodeIgniterPlus) in details also.


*nix Installation
-------------------
- Change application/config/database.php according to your database server credential and commit locally(or add that file to .gitignore file).
- Create a makefile as instructed on [deployment wiki](https://github.com/ranacseruet/codeigniterplus/wiki/Deployment) page.
- run the 'make all' command.

Windows Installation
------------

This project is tightly coupled with composer and bower. So, make sure you have them installed and you know the basics!

- Crate a new project with your chosen name. 
- Paste all file from CodeIgniterPlus to your project directory.
- Run "composer update" command to get doctrine dependency installed.
- Run "bower install" command to get latest front-end packages installed.
- Change 'RewriteBase' on '.htaccess' file as per your your chosen name. If using root level domain, just remove it and keep as 'RewriteBase /'. 
- Create a database with your given database name in config/database.php file.
- Now edit config/database.php file; Here change the database server, database name, user name and password as per your database server.
- Make sure the following directories exists(create if not) and do have write permission by the application(easy to have them with '777' mode):
    * {root}/application/cache
    * {root}/application/logs
    * {root}/application/models/proxies
- Run http://{domain_path}/home/db_schema for create database tables from the doctrine entities, automatically.
  (Note :Every time when you update your entity file in models/entity directory just Run the above url for update existing schema.)
- run the application, register with username 'admin'. This will cause to create default two roles 'admin' and user automatically and will 
  make user 'admin' in 'admin' role. From this on, whenever a registration happens, all will be assigned default 'user' role.
  (Note: If you wish to change this functionality please do so on 'application/libraries/DX_Auth.php', starting at line 930.)

HomePage Screenshot:
-------------------
[Codeigniterplus Home Screen](https://raw.githubusercontent.com/ranacseruet/codeigniterplus/master/images/desktop_mobile.png)


References:
----------
And introductory post to codeigniterplus: [Introduction To CodeIgniterplus](http://codesamplez.com/project/codeigniter-bundle )

Future Considerations:
----------------------

- Docker Integration(in progress!)
- Front End enhancements: integrate [requirejs](http://requirejs.org/), [angularjs](https://angularjs.org/), [grunt](http://gruntjs.com/).
- Unit Tests: add necessary [PHPUnit](http://phpunit.de/) tests for custom classes.
- Acceptance/Functional Test: Using [Codeception](http://codeception.com/).
- Support for other view engine: Current view engine logic already seperated to MY_Controller class. Additional logic should be integrated to generalize view engine choice, so that developers can use other engines they like, such as [twig](http://twig.sensiolabs.org/) 

Your Contribution
-------------------

- [Report a bug](https://github.com/ranacseruet/codeigniterplus/labels/bug)
- [Feature Suggestion](https://github.com/ranacseruet/codeigniterplus/labels/enhancement)

You can choose from the above 'Future considerations' section as well. In that case, you can optionally create a [issue](https://github.com/ranacseruet/codeigniterplus/issues) mentioning which feature you want to work on. Then, fork the repo, implement the feature/make changes and create a pull request. Thanks!

