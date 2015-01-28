<?php
/*
 * This file is part of the Julatools project.
 *
 * (c) Julatools project <http://github.com/julatools/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace julatools\configmanager\models;

use Yii;

/**
 * This is the model class for table "{{%sys_config_user}}".
 *
 * @property integer $ID
 * @property integer $user_ID
 * @property integer $config_ID
 *
 * @property SysUser $user
 * @property SysConfig $config
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class ConfigUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_config_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_ID', 'config_ID'], 'integer'],
        	[['user_ID', 'config_ID'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('configmanager', 'ID'),
            'user_ID' => Yii::t('configmanager', 'User'),
            'config_ID' => Yii::t('configmanager', 'Config-Set'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(SysUser::className(), ['id' => 'user_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfig()
    {
        return $this->hasOne(SysConfig::className(), ['ID' => 'config_ID']);
    }
}