<?php

// models/Avaliacao.php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Avaliacao extends ActiveRecord
{
    public static function tableName()
    {
        return 'avaliacao'; // Certifique-se de ajustar o nome da tabela, se necessário
    }

    public function rules()
    {
        return [
            [['nota', 'comentario', 'id_servico', 'id_usuario'], 'required'],
            [['id_servico', 'id_usuario'], 'integer'],
            [['nota'], 'number'],
            [['comentario'], 'string'],
            [['data'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nota' => 'Nota',
            'comentario' => 'Comentário',
            'data' => 'Data',
            'id_servico' => 'ID do Serviço',
            'id_usuario' => 'ID do Usuário',
        ];
    }

    // Relação com o modelo Servico
    public function getServico()
    {
        return $this->hasOne(Servico::class, ['id' => 'id_servico']);
    }

    // Relação com o modelo conta
    public function getConta()
    {
        return $this->hasOne(Conta::class, ['id' => 'id_usuario']);
    }
}
