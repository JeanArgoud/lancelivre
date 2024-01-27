<?php
// models/Mensagem.php

namespace app\models;

use yii\db\ActiveRecord;

class Mensagem extends ActiveRecord
{
    public static function tableName()
    {
        return 'mensagem';
    }

    public function rules()
    {
        return [
            [['id_canal', 'data_envio', 'texto'], 'required'],
        ];
    }
}
