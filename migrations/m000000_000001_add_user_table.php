<?php

use yii\db\Schema;
use yii\db\Migration;

class m000000_000001_add_user_table extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => 'pk',
            'email' => Schema::TYPE_STRING.' NOT NULL',
            'password_hash' => Schema::TYPE_STRING.' NOT NULL',
            'auth_key' => Schema::TYPE_STRING.' NOT NULL',
            'access_token' => Schema::TYPE_STRING.' NULL',
        ], 'ENGINE=InnoDB');

        $this->createIndex('user_email', 'user', 'email', true);
        $this->createIndex('user_auth_key', 'user', 'auth_key', true);
    }

    public function down()
    {
        echo "m000000_000001_add_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
