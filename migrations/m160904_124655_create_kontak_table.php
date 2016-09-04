<?php

use yii\db\Migration;

/**
 * Handles the creation for table `kontak`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m160904_124655_create_kontak_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('kontak', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'nama' => $this->string(255)->notNull(),
            'no_hp' => $this->string(15),
            'whatsapp' => $this->string(15),
            'telegram' => $this->string(20),
            'line' => $this->string(20),
            'bbm' => $this->string(10),
            'dibuat_pada' => $this->integer(10),
            'diperbarui_pada' => $this->integer(10),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-kontak-user_id',
            'kontak',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-kontak-user_id',
            'kontak',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-kontak-user_id',
            'kontak'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-kontak-user_id',
            'kontak'
        );

        $this->dropTable('kontak');
    }
}
