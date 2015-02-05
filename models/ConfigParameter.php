<?php
/*
 * This file is part of the 7well project.
 *
 * (c) 7well project <http://github.com/7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace 7well\configmanager\models;

use Yii;

/**
 * This is the model class for table "{{%sys_config_parameter}}".
 *
 * @property integer $ID
 * @property integer $config_ID
 * @property integer $parameter_ID
 * @property string $value
 *
 * @property SysConfig $config
 * @property SysParameter $parameter
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class ConfigParameter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_config_parameter}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['config_ID', 'parameter_ID'], 'required'],
            [['config_ID', 'parameter_ID'], 'integer'],
            [['value'], 'string'],
        	[['config_ID', 'parameter_ID'], 'checkUniquePair']
        ];
    }

    public function checkUniquePair($attribute, $params)
    {
    	$configparameter = ConfigParameter::findOne(['ID'=>$this->ID]);
    	if(!isset($configparameter))
    	{ 
    		$configparameter = ConfigParameter::findOne(['config_ID'=>$this->config_ID, 'parameter_ID'=>$this->parameter_ID]);
    		if(isset($configparameter))
    		{
    			$this->addError('parameter_ID','Parameter already exist in this Config-Set');
    		}
    	}
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('configmanager', 'ID'),
            'config_ID' => Yii::t('configmanager', 'Config-Set'),
            'parameter_ID' => Yii::t('configmanager', 'Parameter'),
            'value' => Yii::t('configmanager', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfig()
    {
        return $this->hasOne(Config::className(), ['ID' => 'config_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameter()
    {
        return $this->hasOne(Parameter::className(), ['ID' => 'parameter_ID']);
    }
}