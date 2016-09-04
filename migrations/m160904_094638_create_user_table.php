<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160904_094638_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(20)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'dibuat_pada' => $this->integer(10),
            'diperbarui_pada' => $this->integer(10),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
