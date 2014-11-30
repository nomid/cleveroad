<?php

use yii\db\Schema;
use yii\db\Migration;

class m141130_112527_create_index_to_auth_key_in_users extends Migration
{
    public function up()
    {
        $this->createIndex('auth_key_i', 'users', 'auth_key');
    }

    public function down()
    {
        $this->dropIndex('auth_key_i', 'users');
    }
}
