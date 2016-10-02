<?php

namespace app\controllers;

use Yii;




class SiteController extends Controller
{
    
    /**
    * Displays homepage.
    *
    * @return string
    */
    public function actionIndex()
    {
        return ['message'=>'Welcome to BarBek API.'];
    }
    
   
    
    /*
    *  Error action
    *
    */
    
    public function actionError(){
        $error = Yii::$app->errorHandler->exception;
        
        return $error;
        
    }
}