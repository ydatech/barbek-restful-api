<?php

use yii\db\Migration;

/**
 * Handles the creation for table `iklan`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `kota`
 * - `subkategori`
 * - `kontak`
 */
class m160911_143817_create_iklan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('iklan', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'judul' => $this->string(255)->notNull(),
            'deskripsi' => $this->text()->notNull(),
            'harga' => $this->decimal(30)->notNull(),
            'foto' => $this->text()->notNull(),
            'kota_id' => $this->integer()->notNull(),
            'subkategori_id' => $this->integer()->notNull(),
            'kontak_id' => $this->integer()->notNull(),
            'dibuat_pada' => $this->integer(10),
            'diperbarui_pada' => $this->integer(10),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-iklan-user_id',
            'iklan',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-iklan-user_id',
            'iklan',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `kota_id`
        $this->createIndex(
            'idx-iklan-kota_id',
            'iklan',
            'kota_id'
        );

        // add foreign key for table `kota`
        $this->addForeignKey(
            'fk-iklan-kota_id',
            'iklan',
            'kota_id',
            'kota',
            'id',
            'CASCADE'
        );

        // creates index for column `subkategori_id`
        $this->createIndex(
            'idx-iklan-subkategori_id',
            'iklan',
            'subkategori_id'
        );

        // add foreign key for table `subkategori`
        $this->addForeignKey(
            'fk-iklan-subkategori_id',
            'iklan',
            'subkategori_id',
            'subkategori',
            'id',
            'CASCADE'
        );

        // creates index for column `kontak_id`
        $this->createIndex(
            'idx-iklan-kontak_id',
            'iklan',
            'kontak_id'
        );

        // add foreign key for table `kontak`
        $this->addForeignKey(
            'fk-iklan-kontak_id',
            'iklan',
            'kontak_id',
            'kontak',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-iklan-user_id',
            'iklan'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-iklan-user_id',
            'iklan'
        );

        // drops foreign key for table `kota`
        $this->dropForeignKey(
            'fk-iklan-kota_id',
            'iklan'
        );

        // drops index for column `kota_id`
        $this->dropIndex(
            'idx-iklan-kota_id',
            'iklan'
        );

        // drops foreign key for table `subkategori`
        $this->dropForeignKey(
            'fk-iklan-subkategori_id',
            'iklan'
        );

        // drops index for column `subkategori_id`
        $this->dropIndex(
            'idx-iklan-subkategori_id',
            'iklan'
        );

        // drops foreign key for table `kontak`
        $this->dropForeignKey(
            'fk-iklan-kontak_id',
            'iklan'
        );

        // drops index for column `kontak_id`
        $this->dropIndex(
            'idx-iklan-kontak_id',
            'iklan'
        );

        $this->dropTable('iklan');
    }
}
