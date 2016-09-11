<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subkategori".
 *
 * @property integer $id
 * @property integer $kategori_id
 * @property string $nama
 *
 * @property Iklan[] $iklans
 * @property Kategori $kategori
 */
class Subkategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subkategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori_id'], 'required'],
            [['kategori_id'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['kategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::className(), 'targetAttribute' => ['kategori_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori_id' => 'Kategori ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIklans()
    {
        return $this->hasMany(Iklan::className(), ['subkategori_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['id' => 'kategori_id']);
    }
}
