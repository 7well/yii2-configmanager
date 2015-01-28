<?php
/*
 * This file is part of the Julatools project.
 *
 * (c) Julatools project <http://github.com/julatools/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
use yii\db\Schema;
use yii\db\Migration;

class m150122_193221_init extends Migration
{
    public function up()
    {
    	$this->createTable('{{%sys_parameter}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'bootstrap'            => Schema::TYPE_BOOLEAN,
    			'parametername'        => Schema::TYPE_STRING . '(255) NOT NULL',
    			'value'		   		   => Schema::TYPE_TEXT,
    			'defaultvalue'		   => Schema::TYPE_TEXT,
    			'comment'		   	   => Schema::TYPE_STRING . '(255)',
    			'module_ID'			   => Schema::TYPE_INTEGER,
    	]);

    	$this->createIndex('sys_parameter_unique_para', '{{%sys_parameter}}', 'parametername, module_ID', true);
    	
    	$this->createTable('{{%sys_config}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'titel'			   	   => Schema::TYPE_STRING . '(100) NOT NULL',
    			'parent_ID'		   	   => Schema::TYPE_INTEGER,
    			'comment'		   	   => Schema::TYPE_STRING . '(255)',
    	]);
    	
    	$this->createTable('{{%sys_config_parameter}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'config_ID'			   => Schema::TYPE_INTEGER . ' NOT NULL',
    			'parameter_ID'		   => Schema::TYPE_INTEGER . ' NOT NULL',
    			'value'		   		   => Schema::TYPE_TEXT,
    	]);
    	
    	$this->createTable('{{%sys_config_user}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'user_ID'		   	   => Schema::TYPE_INTEGER,
    			'config_ID'		   	   => Schema::TYPE_INTEGER,
    	]);
    	
    	$this->addForeignKey('fk_sys_config_parameter_parameter', '{{%sys_config_parameter}}', 'parameter_ID', '{{%sys_parameter}}', 'ID', 'CASCADE');
    	$this->addForeignKey('fk_sys_config_parameter_config', '{{%sys_config_parameter}}', 'config_ID', '{{%sys_config}}', 'ID', 'CASCADE');
    	$this->addForeignKey('fk_sys_config_config', '{{%sys_config}}', 'parent_ID', '{{%sys_config}}', 'ID');
    	$this->addForeignKey('fk_sys_config_user_config', '{{%sys_config_user}}', 'config_ID', '{{%sys_config}}', 'ID', 'CASCADE');
    	$this->addForeignKey('fk_sys_config_user_user', '{{%sys_config_user}}', 'user_ID', '{{%sys_user}}', 'ID', 'CASCADE');
    }

    public function down()
    {
         $this->dropTable('{{%sys_config_user}}');
         $this->dropTable('{{%sys_config_parameter}}');
         $this->dropTable('{{%sys_config}}');
         $this->dropTable('{{%sys_parameter}}');
    }
}
