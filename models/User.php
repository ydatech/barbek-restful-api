<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\web\UnauthorizedHttpException;
use \Firebase\JWT\JWT;

class User extends ActiveRecord implements IdentityInterface
{
    /*
    * Override method tableName()
    * karena kita tidak menggunakan prefix tbl_ pada database barbek
    * dengan nilai balikkan berupa (string) user
    */
    
    public static function tableName(){
        
        return 'user';
    }
    
    
    /*
    * menambahkan Timestamp Behavior
    */
    public function behaviors()
    {
        return [
        
        [
        'class' => TimestampBehavior::className(),
        'createdAtAttribute' => 'dibuat_pada',
        'updatedAtAttribute' => 'diperbarui_pada',
        ],
        ];
    }
    
    
    /**
    * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    
    /**
    *  Temukan user berdasarkan JWT token yang diberikan melalui  @param $token
    */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $secret = base64_encode(Yii::$app->params['JWT']['secret_key']);
        try{
            // decode token
            
            $jwt = JWT::decode($token,$secret, [Yii::$app->params['JWT']['algorithm']]);
            
            // temukan user berdasrkan jti / id user
            
            return static::findOne($jwt->jti);
            
        }catch(\Exception $e){
            
            // throw UnauthorizedHttpException jika token tidak valid
            throw new UnauthorizedHttpException(Yii::t('yii','Invalid or Expired Token'));
            
        }
        
    }
    
    /**
    * Finds user by username
    *
    * @param string $username
    * @return static|null
    */
    public static function findByUsername($username)
    {
        return static::findOne(['username'=>$username]);
        
    }
    
    /**
    * retrun uniq id dari user (primary key)
    * @inheritdoc
    */
    public function getId()
    {
        return $this->id;
    }
    
    /**
    * @inheritdoc
    * Tidak akan digunakan
    * Karena aplikasi kita tidak menggunakan autologin
    * Aplikasi BarBek stateless
    */
    public function getAuthKey()
    {
        return null;
    }
    
    /**
    * @inheritdoc
    * Tidak akan digunakan
    * Karena aplikasi kita tidak menggunakan autologin
    * Aplikasi BarBek stateless
    */
    public function validateAuthKey($authKey)
    {
        return false;
    }
    
    /**
    * Validasi password dengan password hash
    *
    * @param string $password password to validate
    * @return boolean if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
    
    /*
    * Generate password hash dari password yang diberikan user kemudian simpan pada field password
    *
    */
    public function setPassword($password){
        
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    /*
    * Generate JWT untuk user
    *
    */
    
    public function generateJWT(){
        
        // configurasi JWT Token
        $secret      = base64_encode(Yii::$app->params['JWT']['secret_key']);
        $issuedAt = time();
        $notBefore = $issuedAt;
        $expiredTime = $currentTime + (3600 * 24 * 30); // Expired dalam 30 hari
        $hostInfo    = Yii::$app->request->hostInfo;
        
        
        
        $token = [
        
        'iat'  => $issuedAt,         // Issued at: waktu saat token digenerate
        'jti'  => $this->getId(),       // Json Token Id: user id
        'iss'  => $hostInfo,       // Issuer : domain dimana token digenerate/dibuat
        'aud' => $hostInfo,    // audience : domain dimana token bisa digunakan
        'nbf'  => $notBefore,        // Not before : token tidak dapat digunakan sebelum
        'exp'  => $expiredTime,           // Expired time : waktu token expired
        ];
        
        
        return JWT::encode($token, $secret, Yii::$app->params['JWT']['algorithm']);
    }
}