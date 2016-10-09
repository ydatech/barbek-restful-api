<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
* This is the model class for table "kontak".
*
* @property integer $id
* @property integer $user_id
* @property string $nama
* @property string $no_hp
* @property string $whatsapp
* @property string $telegram
* @property string $line
* @property string $bbm
* @property integer $dibuat_pada
* @property integer $diperbarui_pada
*
* @property User $user
*/
class Kontak extends ActiveRecord
{
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'kontak';
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
        	[
			'class'=>AttributeBehavior::className(),
			'attributes'=>[
			ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
			],
			'value'=>function($event){
				return Yii::$app->user->id;
			}
			
			]
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
        [[ 'nama'], 'required' , 'message'=>'Nama tidak boleh kosong'],
        [['user_id', 'dibuat_pada', 'diperbarui_pada'], 'integer'],
        [['nama'], 'string', 'max' => 255],
        [['no_hp', 'whatsapp'], 'string', 'max' => 15],
        [['telegram', 'line'], 'string', 'max' => 20],
        [['bbm'], 'string', 'max' => 10],
        [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'user_id' => 'User ID',
        'nama' => 'Nama',
        'no_hp' => 'No Hp',
        'whatsapp' => 'Whatsapp',
        'telegram' => 'Telegram',
        'line' => 'Line',
        'bbm' => 'Bbm',
        'dibuat_pada' => 'Dibuat Pada',
        'diperbarui_pada' => 'Diperbarui Pada',
        ];
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}