<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
* Handles the creation for table `kota`.
* Has foreign keys to the tables:
*
* - `provinsi`
*/
class m160904_141243_create_kota_table extends Migration
{
    /**
    * @inheritdoc
    */
    public function safeUp()
    {
        $this->createTable('kota', [
        'id' => $this->primaryKey(),
        'provinsi_id' => $this->integer()->notNull(),
        'nama' => $this->string(50),
        ]);
        
        // creates index for column `provinsi_id`
        $this->createIndex(
        'idx-kota-provinsi_id',
        'kota',
        'provinsi_id'
        );
        
        // add foreign key for table `provinsi`
        $this->addForeignKey(
        'fk-kota-provinsi_id',
        'kota',
        'provinsi_id',
        'provinsi',
        'id',
        'CASCADE'
        );
        
        // path tempat file csv berada
        $kota = Yii::getAlias('@app/migrations/kota.csv');
        
        // baca file csv menggunakan lebrary league\csv
        $reader = Reader::createFromPath($kota);
        
        // insert data kota kedalam tabel provinsi
        foreach ($reader as $index => $row) {
            $this->insert('kota', [
            'id' => (int)$row[0],
            'provinsi_id'=>(int)$row[1],
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
        $kota = Yii::getAlias('@app/migrations/kota.csv');
        
        // baca file csv menggunakan lebrary league\csv
        $reader = Reader::createFromPath($kota);
        
        // hapus data provinsi dari tabel provinsi
        foreach ($reader as $index => $row) {
            $this->delete('kota', ['id' => (int)$row[0]]);
            
        }
        // drops foreign key for table `provinsi`
        $this->dropForeignKey(
        'fk-kota-provinsi_id',
        'kota'
        );
        
        // drops index for column `provinsi_id`
        $this->dropIndex(
        'idx-kota-provinsi_id',
        'kota'
        );
        
        $this->dropTable('kota');
    }
}