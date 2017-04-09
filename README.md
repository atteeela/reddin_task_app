Reddin Task Project
========================

The purpose of this project is to show case the Symfony3 technical stack.

Specifically the application has the following capabilities:

1.	User Login
- User should log in using their email
- Once logged in a user should land on a page with the URL /home/welcome
- The page should host provided logo image and a link to edit profile page
- Logins are to be stored in a database
2.	A page where user can edit their profile (link to from step 1)
- Change First and Last names
- Change password
- Link back to /home/welcome
3.	Command to import user CSV file into the database
- This command should create user accounts
- Passwords can be set to user’s first name (for ease of evaluation)
- If the command is re-run it should update duplicate user accounts with new information, but passwords should remain untouched

Requirements
--------------
Application is tested to work with:

- Mac OSX Sierra (10.12)
- Php 7.1.x
- Phpunit 5.7
- MySQL 5.5.x

Installation
--------------
```
php composer.phar update
```

Database Setup
--------------

1. Install MySQL 5.5+
- Default user: root, password: yourpassword (For this example here)
- Alternatively, change the database access in **app/config/config_dev.yml** and **app/config/config_test.yml**

2. Create the databases 'reddin_task_db_test', 'reddin_task_db_dev' and 'reddin_task_db_production' (last one only if you plan to deply to Production)

Use your favourite tool (SequelPro, msyql CLI, etc).

Or run with these commands:
```
php bin/console doctrine:database:create -e dev
```
```
php bin/console doctrine:database:create -e test
```

3. Check the status of the migrations (Now that the database schema is created)

```
php bin/console  doctrine:migrations:status --show-versions
```

4. Run the migrations
```
php bin/console doctrine:migrations:migrate -e dev
```

```
php bin/console doctrine:migrations:migrate -e test
```

Resources:
https://github.com/doctrine/DoctrineMigrationsBundle
https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html

Loading Users
--------------
```
php bin/console app:load-users tests/AppBundle/Command/user-data.csv -e dev 
```

Runnning Server
--------------
```
php bin/console server:run

(Now navigate to http://localhost:8000)

```

Running Tests
--------------

```
$ phpunit
PHPUnit 5.7.19 by Sebastian Bergmann and contributors.

..................                                                18 / 18 (100%)

Time: 21.07 seconds, Memory: 38.00MB

OK (18 tests, 378 assertions)

```

Debugging with PHP xdebug
--------------

## Install xdebug
Mac OSX (Homebrew)
```
$ brew install homebrew/php/php56-xdebug
```
It may present some errors related to linking libpng, libjpeg, 
etc (just follow the instructions to resolve them one by one)

Once xdebug is installed, then you can run PhpStorm and set breakpoints in code to step through.

**Run Unit Tests with Xdebug Via Phpstorm**

Works immediately with no additional configuration

**Run Symfony/PHP built-in Web Server**

1. Create a custom run configuration (Run->Edit Configurations)
2. Choose 'PHP Script'
3. Specify path to 'project_dir/bin/console'
4. Pass in additional argument 'server:run'
5. Run!

**Debug with Symfony/PHP via Web Browser**

This is a work-around for the limitations of not being able to use PHP Storm 2017.1 
and Symfony3 xdebugging.

1. Install xdebug extension https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc
2. Setup xdebug extensions. in chrome://extensions find Xdebug helper and click options. there select IDE key to PhpStorm. (this will essentially set xdebug.idekey to PHPSTORM for that particular session)
3. now the trickiest part, connecting from PhpStorm. you have to setup PHP Remote Debug debug configuration.

Notes from http://stackoverflow.com/questions/18517083/how-to-set-up-remote-debugging-for-symfony2-with-phpstorm-and-xdebug

In the toolbar, next to the debug button, you have drop down field with the first option Edit configuration. it opens Run/Debug Configurations.
there click the + button and add PHP Remote Debug.

specify your name, server and Ide key = PHPSTORM.

click Apply and Ok (i never know which one so i always click both, just in case)

now the dropdown in the toolbar will show your newly set remote server, run button (green arrow) will be disabled.

click Start Listen for PHP Debug Connection

click that green bug icon to start debugging

Debug view will open with 2 tabs: Debugger and Console (selected by default)

Change the tab to Debugger and you will see: "Waiting for incoming connection with the ide key 'PHPSTORM'"
open your browser

Navigate to your server url

Activate Xdebug helper extension (clicking on that gray bug in the url bar) it will turn green

To check that everything is ok, open Chrome console, tab Resources -> Cookies -> your server. and verify that cookie XDEBUG_SESSION with value PHPSTORM was created (this is what actually activates xdebug remote debugging in php)

Now refresh the page and quickly alt-tab back to PhpStorm (or arrange your windows so you can see PhpStorm while refreshing browser)

In your Debug view and Debugger console you will briefly see "Connected"
 

Resources:
https://xdebug.org/docs/install
http://stackoverflow.com/questions/18517083/how-to-set-up-remote-debugging-for-symfony2-with-phpstorm-and-xdebug
https://www.jetbrains.com/help/phpstorm/2017.1/configuring-xdebug.html
https://confluence.jetbrains.com/display/PhpStorm/Profiling+PHP+applications+with+PhpStorm+and+Xdebug

Updating Application
--------------
```
php composer.phar  update
```

Available Commands List
--------------

Show list of available commands:
```
php bin/console
```

Security and Privacy Measures
--------------


Password safety (storage, hashing, salting):

http://php.net/manual/en/faq.passwords.php
https://crackstation.net/hashing-security.htm

Updating PHP 5.6 -> PHP 7.1
--------------

https://jason.pureconcepts.net/2016/09/upgrade-php-mac-os-x/
