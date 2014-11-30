<?php

use yii\db\Schema;
use yii\db\Migration;

class m141130_103003_add_is_activated_and_index_to_email_in_users extends Migration
{
    /**
     *
     */
    public function up()
    {
        $this->addColumn('users', 'is_activated', Schema::TYPE_SMALLINT.' default 0');
        $this->createIndex('email_i', 'users', 'email', true);
    }

    public function down()
    {
        $this->dropColumn('users', 'is_activated');
        $this->dropIndex('email_i', 'users');
    }
}
