<?php

/*
 * This file is part of the chd7well project.
 *
 * (c) chd7well project <http://github.com/chd7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace chd7well\configmanager\models;

use chd7well\configmanager\models\Parameter;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ParameterSearch represents the model behind the search form about Parameter.
 *
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */


class ParameterSearch extends Parameter
{
    /** @var string */
    public $parametername;

    /** @var string */
    public $comment;
    
    /** @var string */
    public $defaultvalue;

       /** @inheritdoc */
    public function rules()
    {
        return [
            [['parametername', 'comment', 'defaultvalue'], 'string'],
        	[['bootstrap'], 'safe'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'parametername'        => \Yii::t('configmanager', 'Parameter name'),
            'comment'           => \Yii::t('configmanager', 'Comment'),
            'defaultvalue'      => \Yii::t('configmanager', 'Default value'),
        	'bootstrap'      => \Yii::t('configmanager', 'On bootstrap (search on/ON)'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Parameter::find();
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
		->andFilterWhere(['like', 'parametername', $this->parametername])
		->andFilterWhere(['like', 'value', $this->value])
		->andFilterWhere(['like', 'defaultvalue', $this->defaultvalue]);
		
		if(isset($this->bootstrap))
		{
			if(!strcasecmp($this->bootstrap,"on"))
			{
				$query->andFilterWhere(['like', 'bootstrap', 1]);
			}
			else if(!strcasecmp($this->bootstrap,"off"))
			{
				$query->andFilterWhere(['like', 'bootstrap', 0]);
			}
			
		}
		return $dataProvider;
    }
}
