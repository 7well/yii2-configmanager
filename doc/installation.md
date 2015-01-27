Installation
============

This document will guide you through the process of installing Yii2-configmanager using **composer**. Installation is a quick and
easy three-step process.

Step 1: Download Yii2-user using composer
-----------------------------------------

Add `"julatools/yii2-configmanager": "*"` to the require section of your **composer.json** file. And run `composer update`
to download and install Yii2-configmanager.
Note: yii2-configmanager needs the julatools/yii2-user package. For configure this package see https://github.com/julatools/yii2-user

Step 2: Configure your application
------------------------------------

> **NOTE:** Make sure that you don't have any `configmanager` component configuration in your config files.

Add following lines to your main configuration file:

```php
'modules' => [
...
    'configmanager' => [
            'class' => 'julatools\configmanager\Module' ,
    ],
]
```

Step 3: Update database schema
------------------------------

> **NOTE:** Make sure that you have properly configured **db** application component.

After you downloaded and configured Yii2-configmanager, the last thing you need to do is updating your database schema by applying
the migrations:

```bash
$ php yii migrate/up --migrationPath=@vendor/julatools/yii2-configmanager/migrations
```
> **NOTE:** If you have installed the yii-configmanager per `composer` you must edite the extionsions.php in vendor/yiisoft/: disable bootstrap loading from the yii2-configmanager component apply the migration and activate the bootstrap for die configmanager!

FAQ
---

**Installation failed. There are no files in `vendor/julatools/yii2-configmanager`**

*Try removing Yii2-configmanager version constraint from composer.json, then run `composer update`. After composer finish
 removing of Yii2-configmanager, re-add version constraint and `composer update` again.*

