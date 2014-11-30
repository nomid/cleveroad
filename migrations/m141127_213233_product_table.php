<?php

use yii\db\Schema;
use yii\db\Migration;

class m141127_213233_product_table extends Migration
{
    public function up()
    {
        $this->createTable('products', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'image' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'price' => Schema::TYPE_FLOAT . '(2) NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('products');
    }
}
