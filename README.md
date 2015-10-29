Yii 2 App
=========

This is customized Yii 2 Application Template with user authentication, backoffice, Phing and Vagrant integration. Created for personal use.

INSTALLATION
------------

First step is to create project via Composer:
~~~
composer global require "fxp/composer-asset-plugin:~1.0.3"
composer create-project --prefer-dist herroffizier/yii2-app my-app
~~~

After that go to new project's directory and init project with built-in wizard. It will replace placeholders in various config files to actual values.
~~~~
php yii project/init
~~~~

After you asked all wizard's questions you are ready to run Vagrant. This command will download, configure
and run virtual machine.
~~~
vagrant up
~~~

The final step is to apply db migrations. Run following commands:
~~~
vagrant ssh
cd /vagrant/
./vendor/bin/phing migrate
~~~
