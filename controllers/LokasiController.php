<?php

namespace app\controllers;


use app\models\Provinsi;


class LokasiController extends Controller
{
    
    
    
    public function verbs(){
        // validasi HTTP method untuk index action
        return [
        
        'index'=>['GET']
        ];
    }
    
    
    public function actionIndex(){
        
        // ambil semua baris yang ada pada tabel provinsi 
        // termasuk relasinya dengan tabel kota
        $lokasi = Provinsi::find()
         ->asArray() // set balikan data berupa array (yang secara default adalah object)
         ->with('kota') // relasi yang dibuat pada model Provinsi melalui method getKota()
         ->all();
        

        return $lokasi;
        
    }
    
}