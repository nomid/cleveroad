<?php

use yii\db\Schema;
use yii\db\Migration;

class m141127_213656_add_fk_to_products extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'user_id_fk',
            'products',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey( 'user_id_fk', 'products' );
    }
}
