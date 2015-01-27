<?php

/*
 * This file is part of the jualtools project.
 *
 * (c) Julatools project <http://github.com/julatools/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace julatools\configmanager;

use yii\authclient\Collection;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;
use julatools\configmanager\models\Parameter;
use julatools\configmanager\models\Config;
use julatools\configmanager\models\ConfigUser;
use julatools\configmanager\models\ConfigParameter;

/**
 * Bootstrap class registers configmanager components.
 *
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Bootstrap implements BootstrapInterface
{
    /** @var array Model's map */
    private $_modelMap = [
        'Parameter'             => 'julatools\configmanager\models\Parameter',
    	'ParameterSearch'       => 'julatools\configmanager\models\ParameterSearch',
     	'ConfigSearch'       =>    'julatools\configmanager\models\ConfigSearch',
    	'ConfigParameterSearch'       =>    'julatools\configmanager\models\ConfigSearch',
    	'ConfigUser'       =>    'julatools\configmanager\models\ConfigUser',
    ];

    private function setParameter($app, $parametername, $parametervalue) {
		if ($parametername[0] == '@') { // parameter is a compomnent
			eval ( '$helpdummy = ' . $parametervalue . ';' );
			$app->set ( substr ( $parametername, 1 ), $helpdummy );
		} else if($parametername[0] == '#'){
			eval ( '$helpdummy = ' . $parametervalue . ';' );
			$module = [substr ( $parametername, 1 ) => $helpdummy];
			$app->modules = array_merge($app->modules, $module);
		}
		else {
			$app->params [$parametername] = $parametervalue;
		}
	}
	
    /** @inheritdoc */
    public function bootstrap($app)
    {
    	
        /** @var $module Module */
        if ($app->hasModule('configmanager') && ($module = $app->getModule('configmanager')) instanceof Module) {
            $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);
            foreach ($this->_modelMap as $name => $definition) {
                $class = "julatools\\configmanager\\models\\" . $name;
                \Yii::$container->set($class, $definition);
                $modelName = is_array($definition) ? $definition['class'] : $definition;
                $module->modelMap[$name] = $modelName;
                if (in_array($name, ['Configmanager'])) {
                    \Yii::$container->set($name . 'Query', function () use ($modelName) {
                        return $modelName::find();
                    });
                }
            }
        
            }

            $app->get('i18n')->translations['configmanager*'] = [
                'class'    => PhpMessageSource::className(),
                'basePath' => __DIR__ . '/messages',
            ];

            //Load parameters from database
            $parameters = Parameter::find()->where(['bootstrap'=>'1'])->all();	//only on bootstrap are necessary

            foreach($parameters as $para)
            {
            	$this->setParameter($app, $para->parametername, $para->value);
            }
            
            $is_config_set = Parameter::findOne(['parametername'=>'julatools/configmanager/config_set']);
            $is_user_config_set = Parameter::findOne(['parametername'=>'julatools/configmanager/user_parameter']);
            if(isset($app->params['julatools/configmanager/config_set']) && isset($app->params['julatools/configmanager/user_parameter']) &&
            		$app->params['julatools/configmanager/config_set'] == 1 && $app->params['julatools/configmanager/user_parameter'] ==1 &&
            		isset(\Yii::$app->user->id)
            		)
            {
            	$configuser = ConfigUser::findOne(['user_ID'=> \Yii::$app->user->id]);
            	if(isset($configuser))
            	{
            		$config = Config::findOne(['ID'=> $configuser->config_ID]);
            		$parent_parameters = ConfigParameter::find()->where(['config_ID'=>$config->parent_ID])->all();
            		$user_parameters = ConfigParameter::find()->where(['config_ID'=>$config->ID])->all();
            		foreach($parent_parameters as $para)
            		{
            			$this->setParameter($app, $para->parameter->parametername, $para->value);
            		}
            		foreach($user_parameters as $para)
            		{
            			$this->setParameter($app, $para->parameter->parametername, $para->value);
            		}
            	}
            }
        }
        
    }
