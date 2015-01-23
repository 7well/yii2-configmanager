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
    	'ParameterSearch'             => 'julatools\configmanager\models\ParameterSearch',
    ];

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

            $parameters = Parameter::find()->where(['bootstrap'=>'1'])->all();	//only on bootstrap are necessary

           // \Yii::trace('dump: ' . eval($para->value), __METHOD__);
            foreach($parameters as $para)
            {
            	if($para->parametername[0] === '@')
            	{//parameter is a compomnent
            		eval('$helpdummy = ' . $para->value . ';');
            		$app->set(substr($para->parametername, 1), $helpdummy);
            	}
            	else {
            		$app->params[$para->parametername] = $para->value;
            	}
            }
        }
        
    }
