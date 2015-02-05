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
 * This is the model class for table "{{%sys_config}}".
 *
 * @property integer $ID
 * @property string $title
 * @property integer $parent_ID
 * @property string $comment
 *
 * @property Config $parent
 * @property Config[] $configs
 * @property SysConfigParameter[] $sysConfigParameters
 * @property SysConfigUser[] $sysConfigUsers
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_ID'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('configmanager', 'ID'),
            'title' => Yii::t('configmanager', 'Titel'),
            'parent_ID' => Yii::t('configmanager', 'Parent  Config'),
            'comment' => Yii::t('configmanager', 'Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Config::className(), ['ID' => 'parent_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigs()
    {
        return $this->hasMany(Config::className(), ['parent_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysConfigParameters()
    {
        return $this->hasMany(SysConfigParameter::className(), ['config_ID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysConfigUsers()
    {
        return $this->hasMany(SysConfigUser::className(), ['config_ID' => 'ID']);
    }
}