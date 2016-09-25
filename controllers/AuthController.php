<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\Cors;
use app\models\SignupForm;
use app\models\LoginForm;

class AuthController extends Controller{
    // Override behaviors() untuk menambahkan \yii\filters\Cors
    public function behaviours(){
        $behaviors = parent::behaviors();
        
        // unset / hapus authenticator
        unset($behaviors['authenticator']);
        
        // tambahkan cors filter
        $behaviors['corsFilter'] = [
        'class' => Cors::className(),
        ];
        return $behaviors;
        
    }
    
    public function verbs(){
        // validasi http verbs untuk action signup dan login
        $verbs = [
        'signup'=>['POST'],
        'login'=>['POST']
        ];
        
        return $verbs;
        
    }
    
    /*
    * action signup
    * dapat diakses melalui endpoint /auth/signup
    */
    
    public function actionSignup(){
        $model = new SignupForm();
        
        // load data dari POST request
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        
        if($user = $model->signup()){
            return $user;
        }
        
    }
    
    
    /*
    * action signup
    * dapat diakses melalui endpoint /auth/login
    */
    public function actionLogin(){
        $model = new LoginForm();
        
        // load data dari POST request
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        
        if($jwt = $model->login()){
            
            return $jwt;
        }
        
        
    }
    
    
}