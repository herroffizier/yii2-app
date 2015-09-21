<?php

use yii\db\Migration;
use app\models\User;

class m000000_000005_assign_admin_role extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $users = User::find()->all();
        $admin = $auth->getRole('admin');
        foreach ($users as $user) {
            $auth->assign($admin, $user->id);
        }
    }

    public function down()
    {
        echo "m000000_000005_assign_admin_role cannot be reverted.\n";

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
