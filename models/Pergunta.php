<?php
// models/Pergunta.php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Pergunta extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id_servico', 'id_usuario', 'titulo', 'pergunta','data'], 'required'],
            [['id_servico', 'id_usuario'], 'integer'],
            [['titulo', 'pergunta', 'resposta'], 'string'],
            [['data'], 'safe'],
        ];
    }

    public static function tableName()
    {
        return 'pergunta'; // Certifique-se de ajustar o nome da tabela, se necessário
    }
    
    // Relacionamento com a tabela Usuario
    public function getUsuario()
    {
        return $this->hasOne(Conta::class, ['id' => 'id_usuario']);
    }
}
