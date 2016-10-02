<?php

namespace app\controllers;


use app\models\Kategori;


class KategoriController extends Controller
{
    
    
    public function verbs(){
        // validasi HTTP method untuk index action
        return [
        
        'index'=>['GET']
        ];
    }
    
    
    public function actionIndex(){
        
        // ambil semua baris yang ada pada tabel kategori 
        // termasuk relasinya dengan tabel sub_kategori

    
        $lokasi =Kategori::find()
         ->asArray() // set balikan data berupa array (yang secara default adalah object)
         ->with('subkategori') // relasi yang dibuat pada model Kategori melalui method getSubkategori()
         ->all();
        

        return $lokasi;
        
    }
    
}