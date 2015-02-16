<?php
/*
 * This file is part of the chd7well project.
 *
 * (c) chd7well project <http://github.com/chd7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace  chd7well\configmanager\models;

use Yii;

/**
 * This is the model class for table "{{%sys_parameter}}".
 * @author Christian Dumhart <christian.dumhart@chd.at>
 * 
 * @property integer $ID
 * @property integer $bootstrap
 * @property string $parametername
 * @property string $value
 * @property string $defaultvalue
 * @property integer $module_ID
 * @property SysConfigParameter[] $sysConfigParameters
 */
class Parameter extends \yii\db\ActiveRecord
{
	//public $dummy;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_parameter}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bootstrap', 'module_ID'], 'integer'],
            [['parametername'], 'required'],
            [['value', 'defaultvalue'], 'string'],
            [['parametername'], 'string', 'max' => 255],
            [['parametername', 'module_ID'], 'unique', 'targetAttribute' => ['parametername', 'module_ID'], 'message' => 'The combination of Parametername and Module  ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('configmanager', 'ID'),
            'bootstrap' => Yii::t('configmanager', 'On bootstrap (on/off)'),
            'parametername' => Yii::t('configmanager', 'Parameter name'),
            'value' => Yii::t('configmanager', 'Value'),
            'defaultvalue' => Yii::t('configmanager', 'Default value'),
            'module_ID' => Yii::t('configmanager', 'Module'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysConfigParameters()
    {
        return $this->hasMany(SysConfigParameter::className(), ['parameter_ID' => 'ID']);
    }
    
    public static function getParameterValue($parametername="")
    {
    	$para = Parameter::findOne(['parametername' => $parametername]);
    	if(isset($para))
    	{
    	return $para->value;	
    	}
    	else
    	{
    		return null;
    	}
    }
}
?>