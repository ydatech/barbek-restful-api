<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Handles the creation for table `subkategori`.
 * Has foreign keys to the tables:
 *
 * - `kategori`
 */
class m160911_131907_create_subkategori_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('subkategori', [
            'id' => $this->primaryKey(),
            'kategori_id' => $this->integer()->notNull(),
            'nama' => $this->string(255),
        ]);

        // creates index for column `kategori_id`
        $this->createIndex(
            'idx-subkategori-kategori_id',
            'subkategori',
            'kategori_id'
        );

        // add foreign key for table `kategori`
        $this->addForeignKey(
            'fk-subkategori-kategori_id',
            'subkategori',
            'kategori_id',
            'kategori',
            'id',
            'CASCADE'
        );

        // path tempat file csv berada
        $subkategori = Yii::getAlias('@app/migrations/subkategori.csv');
        
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($subkategori);
        
        // insert data kota kedalam tabel provinsi
        foreach ($reader as $index => $row) {
            $this->insert('subkategori', [
            'id' => (int)$row[0],
            'kategori_id'=>(int)$row[1],
            'nama' => $row[2],
            ]);
        }



    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

         // path tempat file csv berada
        $subkategori = Yii::getAlias('@app/migrations/subkategori.csv');
        
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($subkategori);

         // hapus data provinsi dari tabel provinsi
        foreach ($reader as $index => $row) {
            $this->delete('subkategori', ['id' => (int)$row[0]]);
            
        }
        
        // drops foreign key for table `kategori`
        $this->dropForeignKey(
            'fk-subkategori-kategori_id',
            'subkategori'
        );

        // drops index for column `kategori_id`
        $this->dropIndex(
            'idx-subkategori-kategori_id',
            'subkategori'
        );

        $this->dropTable('subkategori');
    }
}
