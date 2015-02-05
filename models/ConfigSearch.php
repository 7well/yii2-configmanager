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

use 7well\configmanager\models\Config;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ParameterSearch represents the model behind the search form about Parameter.
 *
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */



class ConfigSearch extends Parameter
{
    /** @var string */
    public $title;

    /** @var string */
    public $comment;

    
       /** @inheritdoc */
    public function rules()
    {
        return [
            [['title', 'comment'], 'string'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'title'        => \Yii::t('configmanager', 'Config title'),
            'comment'           => \Yii::t('configmanager', 'Comment'),
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Config::find();
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
		->andFilterWhere(['like', 'title', $this->title])
		->andFilterWhere(['like', 'comment', $this->comment]);
		
		return $dataProvider;
    }
}
