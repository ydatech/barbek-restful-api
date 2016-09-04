<?php


use yii\db\Migration;
use League\Csv\Reader;
/**
* Handles the creation for table `provinsi`.
*/
class m160904_132618_create_provinsi_table extends Migration
{
    /**
    * @inheritdoc
    */
    public function safeUp()
    {
        $this->createTable('provinsi', [
        'id' => $this->primaryKey(),
        'nama' => $this->string(50),
        ]);
        
        // path tempat file csv berada 
        $provinsi = Yii::getAlias('@app/migrations/provinsi.csv');

        // baca file csv menggunakan lebrary league\csv
        $reader = Reader::createFromPath($provinsi);

        // insert data provinsi kedalam tabel provinsi
        foreach ($reader as $index => $row) {
           $this->insert('provinsi', [
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
        $provinsi = Yii::getAlias('@app/migrations/provinsi.csv');

        // baca file csv menggunakan lebrary league\csv
        $reader = Reader::createFromPath($provinsi);

         // hapus data provinsi dari tabel provinsi
        foreach ($reader as $index => $row) {
             $this->delete('provinsi', ['id' => (int)$row[0]]);
           
        }
        
        $this->dropTable('provinsi');
    }
}