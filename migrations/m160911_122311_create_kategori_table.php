<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
* Handles the creation for table `kategori`.
*/
class m160911_122311_create_kategori_table extends Migration
{
    /**
    * @inheritdoc
    */
    public function safeUp()
    {
        $this->createTable('kategori', [
        'id' => $this->primaryKey(),
        'nama' => $this->string(255),
        ]);
        // path tempat file csv berada
        $kategori = Yii::getAlias('@app/migrations/kategori.csv');
        
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($kategori);
        
        // insert data provinsi kedalam tabel provinsi
        foreach ($reader as $index => $row) {
            $this->insert('kategori', [
            'id' => (int)$row[0],
            'nama' => $row[1],
            ]);
        }
    }
    
    /**
    * @inheritdoc
    */
    public function safeDown()
    {
        // path tempat file csv berada
        $kategori = Yii::getAlias('@app/migrations/kategori.csv');
        
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($kategori);
        
        // hapus data provinsi dari tabel provinsi
        foreach ($reader as $index => $row) {
            $this->delete('kategori', ['id' => (int)$row[0]]);
            
        }
        $this->dropTable('kategori');
    }
}