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

Configruation Sets
---------------
Configuration-Sets can be defined to set special configuration, e.g. config for backends/admin interfaces or special configuration for users. 
The compoment will overwrite the system wide defined parameters (in sys_parameter table) with the new defined values. 
A Configuration-Set can inherent the parameters from a parent config-set.

Parameter usage:
system defined parameter -> config-set (parent -> child):
Child will overwrite defined parameters from parent or system. Parent can overwrite system defined parameters. If a parameter is not defined the system wide defined paramter or the parent parameter is used. It is also possible to leafe the parent set blank.

To use config-set insert or set parameter:
julatools/configmanager/config_set = 1

To use the user defined parameters insert or set parameter in the system wide parameter:
julatools/configmanager/user_parameter = 1




> **NOTE:** No multiple inheritance is supported!

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
