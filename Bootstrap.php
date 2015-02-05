<?php

/*
 * This file is part of the jualtools project.
 *
 * (c) 7well project <http://github.com/7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace 7well\configmanager;

use yii\authclient\Collection;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;
use 7well\configmanager\models\Parameter;
use 7well\configmanager\models\Config;
use 7well\configmanager\models\ConfigUser;
use 7well\configmanager\models\ConfigParameter;

/**
 * Bootstrap class registers configmanager components.
 *
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Bootstrap implements BootstrapInterface
{
    /** @var array Model's map */
    private $_modelMap = [
        'Parameter'             => '7well\configmanager\models\Parameter',
    	'ParameterSearch'       => '7well\configmanager\models\ParameterSearch',
     	'ConfigSearch'       =>    '7well\configmanager\models\ConfigSearch',
    	'ConfigParameterSearch'       =>    '7well\configmanager\models\ConfigSearch',
    	'ConfigUser'       =>    '7well\configmanager\models\ConfigUser',
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
                $class = "7well\\configmanager\\models\\" . $name;
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
            
            $is_config_set = Parameter::findOne(['parametername'=>'7well/configmanager/config_set']);
            $is_user_config_set = Parameter::findOne(['parametername'=>'7well/configmanager/user_parameter']);
		if (get_class ( \Yii::$app ) === 'yii\web\Application') {
			if (isset ( $app->params ['7well/configmanager/config_set'] ) && isset ( $app->params ['7well/configmanager/user_parameter'] ) && $app->params ['7well/configmanager/config_set'] == 1 && $app->params ['7well/configmanager/user_parameter'] == 1 && isset ( \Yii::$app->user->id )) {
				$configuser = ConfigUser::findOne ( [ 
						'user_ID' => \Yii::$app->user->id 
				] );
				if (isset ( $configuser )) {
					$config = Config::findOne ( [ 
							'ID' => $configuser->config_ID 
					] );
					$parent_parameters = ConfigParameter::find ()->where ( [ 
							'config_ID' => $config->parent_ID 
					] )->all ();
					$user_parameters = ConfigParameter::find ()->where ( [ 
							'config_ID' => $config->ID 
					] )->all ();
					foreach ( $parent_parameters as $para ) {
						$this->setParameter ( $app, $para->parameter->parametername, $para->value );
					}
					foreach ( $user_parameters as $para ) {
						$this->setParameter ( $app, $para->parameter->parametername, $para->value );
					}
				}
			}
		}
        }
        
    }
