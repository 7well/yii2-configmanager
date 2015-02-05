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

use 7well\configmanager\models\ConfigParameter;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ParameterSearch represents the model behind the search form about Parameter.
 *
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */



class ConfigParameterSearch extends ConfigParameter
{
    /** @var integer */
    public $config_ID;

    /** @var integer */
    public $parameter_ID;
    
    /** @var string */
    public $value;
    
    
       /** @inheritdoc */
    public function rules()
    {
        return [
            [['config_ID', 'parameter_ID'], 'integer'],
        	[['value'],'string'],
        	[['parameter.parametername'], 'safe'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'config_ID'        => \Yii::t('configmanager', 'Config-Set'),
            'parameter_ID'           => \Yii::t('configmanager', 'Parameter'),
        	'value' => \Yii::t('configmanager', 'Value'),
        ];
    }

    public function attributes(){
    	return array_merge(parent::attributes(), ['parameter.parametername']);
    }
    
    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params, $config_id)
    {
        $query = ConfigParameter::find()->where(['config_ID' => $config_id]);
        $query->joinWith(['parameter']);
		$dataProvider = new ActiveDataProvider([
		'query' => $query,
		]);
		if (!($this->load($params) && $this->validate())) {
		return $dataProvider;
		}
		$query->andFilterWhere(
		[
		'ID' => $this->ID,
		]
		);

		$query
		->andFilterWhere(['like', 'parameter_ID', $this->parameter_ID])
		->andFilterWhere(['like', 'value', $this->value])
		->andFilterWhere(['like', 'sys_parameter.parametername', $this->getAttribute('parameter.parametername')]);
		
		$dataProvider->sort->attributes['parameter.parametername'] = [
				'asc' => ['sys_parameter.parametername' => SORT_ASC],
				'desc' => ['sys_parameter.parametername' => SORT_DESC],
		];
		return $dataProvider;
    }
}
