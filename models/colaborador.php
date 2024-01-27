<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Colaborador extends ActiveRecord
{
    public static function tableName()
    {
        return 'colaborador';
    }

    public function rules()
    {
        return [
            [['nome', 'email', 'data_cadastro'], 'required'],
            [['nome'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['data_cadastro'], 'safe'], 
        ];
    }

    // Adicione métodos específicos do modelo conforme necessário
}
