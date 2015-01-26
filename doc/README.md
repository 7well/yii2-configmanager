Guide to Yii2-configmanager
==================

Quick Info
---------------
No documentation available in this state of deverlopment! 

Only default parameters in sys_parameters are supported yet.
If flag bootstrap is true the parameter or compoment is defined at the bootstrap process, otherwise the parameter can get by the method Parameter::getParameterValue('parametername').
To setup a parameter as a component use a '@' character for parametername:

Example:
-Parameter db:
```
paramtername '@db' value:
[
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => 'topsecrete',
            'charset' => 'utf8',
        ]
```        

Setup:
In your configuration file as new module:
```
'modules' => [
...
	'configmanager' => [
			'class' => 'julatools\configmanager\Module' ,
	],
]
```				

Getting Started
---------------

- [Installation](installation.md)
- [Configuration](configuration.md)
- [List of available actions](available-actions.md)

Overriding
----------

- [Overriding models](overriding-models.md)
- [Overriding views](overriding-views.md)
- [Overriding controllers](overriding-controllers.md)

Basics
------

- [User management](user-management.md)
- [Authentication via social networks](social-auth.md)
- [Mailer](mailer.md)

Guides
------

- [How to add captcha](adding-captcha.md)
