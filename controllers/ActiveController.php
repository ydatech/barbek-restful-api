<?php

namespace app\controllers;


use yii\filters\Cors;
use yii\filters\auth\HttpBearerAuth;


class ActiveController extends  \yii\rest\ActiveController{
    
    // Override behaviors() untuk menambahkan \yii\filters\Cors
    public function behaviors(){
        $behaviors = parent::behaviors();
        
        // unset / hapus authenticator
        unset($behaviors['authenticator']);
        
        // tambahkan cors filter
        $behaviors['corsFilter'] = [
        'class' => Cors::className(),
        ];
        
        //tambahkan HttpBearerAuth untuk autentikasi berbasis token
        $behaviors['authenticator'] = [
        'class' => HttpBearerAuth::className(),
        'except'=>['options']
        ];
        
       
        return $behaviors;
        
    }
    
}