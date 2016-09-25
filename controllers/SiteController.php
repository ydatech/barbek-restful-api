<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\Cors;



class SiteController extends Controller
{
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
        'class' => Cors::className(),
        ];
        return $behaviors;
    }
    
    
    
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