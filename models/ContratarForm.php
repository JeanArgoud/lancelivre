<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\base\Model;

class ContratarForm extends Model
{
    public $id_servico;
    public $id_usuario;
    public $id_cartao;
    
    public function rules(){
        return [
            [['id_cartao', 'id_servico', 'id_usuario'], 'required'],
        ];
    }
}