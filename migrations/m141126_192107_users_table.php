<?php

use yii\db\Schema;
use yii\db\Migration;

class m141126_192107_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
