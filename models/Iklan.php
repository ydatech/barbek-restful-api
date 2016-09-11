<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "iklan".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $judul
 * @property string $deskripsi
 * @property string $harga
 * @property string $foto
 * @property integer $kota_id
 * @property integer $subkategori_id
 * @property integer $kontak_id
 * @property integer $dibuat_pada
 * @property integer $diperbarui_pada
 *
 * @property Kontak $kontak
 * @property Kota $kota
 * @property Subkategori $subkategori
 * @property User $user
 */
class Iklan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iklan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'judul', 'deskripsi', 'harga', 'foto', 'kota_id', 'subkategori_id', 'kontak_id'], 'required'],
            [['user_id', 'kota_id', 'subkategori_id', 'kontak_id', 'dibuat_pada', 'diperbarui_pada'], 'integer'],
            [['deskripsi', 'foto'], 'string'],
            [['harga'], 'number'],
            [['judul'], 'string', 'max' => 255],
            [['kontak_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kontak::className(), 'targetAttribute' => ['kontak_id' => 'id']],
            [['kota_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kota::className(), 'targetAttribute' => ['kota_id' => 'id']],
            [['subkategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subkategori::className(), 'targetAttribute' => ['subkategori_id' => 'id']],
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
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'harga' => 'Harga',
            'foto' => 'Foto',
            'kota_id' => 'Kota ID',
            'subkategori_id' => 'Subkategori ID',
            'kontak_id' => 'Kontak ID',
            'dibuat_pada' => 'Dibuat Pada',
            'diperbarui_pada' => 'Diperbarui Pada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKontak()
    {
        return $this->hasOne(Kontak::className(), ['id' => 'kontak_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKota()
    {
        return $this->hasOne(Kota::className(), ['id' => 'kota_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubkategori()
    {
        return $this->hasOne(Subkategori::className(), ['id' => 'subkategori_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
