<?php

use yii\db\Migration;

class m000000_000004_create_default_user extends Migration
{
    public function up()
    {
        $user = new app\models\User();
        $user->email = 'admin';
        $user->password = 'q123456';
        $user->save();
    }

    public function down()
    {
        echo "m000000_000004_create_default_user cannot be reverted.\n";

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
