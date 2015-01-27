<?php

use yii\db\Schema;
use yii\db\Migration;

class m150126_150548_fix_typo_config extends Migration
{
    public function up()
    {
    	$this->renameColumn('{{%sys_config}}', 'titel', 'title');
    }

    public function down()
    {
        echo "m150126_150548_fix_typo_config cannot be reverted.\n";

        return false;
    }
}
