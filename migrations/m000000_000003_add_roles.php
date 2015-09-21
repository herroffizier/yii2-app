<?php

use yii\db\Migration;

class m000000_000003_add_roles extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $permissions = [];

        $backofficeControllers = [
            'backoffice/dashboard',
        ];

        foreach ($backofficeControllers as $controller) {
            $permission = $auth->createPermission($controller);
            $permission->description = 'Access to '.$controller;
            $auth->add($permission);

            $permissions[$controller] = $permission;
        }

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        foreach ($permissions as $permission) {
            $auth->addChild($admin, $permission);
        }
    }

    public function down()
    {
        echo "m000000_000003_add_roles cannot be reverted.\n";

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
