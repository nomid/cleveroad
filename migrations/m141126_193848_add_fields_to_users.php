<?php

use yii\db\Schema;
use yii\db\Migration;

class m141126_193848_add_fields_to_users extends Migration
{
    public function up()
    {
        $this->addColumn('users', 'auth_key', Schema::TYPE_STRING . ' NOT NULL');
        $this->addColumn('users', 'access_token', Schema::TYPE_STRING . ' NOT NULL');
    }

    public function down()
    {
        $this->alterColumn('users', 'auth_key', Schema::TYPE_STRING . ' NOT NULL');
        $this->alterColumn('users', 'access_token', Schema::TYPE_STRING . ' NOT NULL');
    }
}
