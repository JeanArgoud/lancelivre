<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Pergunta;

class Servico extends ActiveRecord
{
    public $avaliacao_media;

    public static function tableName()
    {
        return 'servico';
    }

    public function rules()
    {
        return [
            [['nome', 'preco', 'colaborador_id', 'avaliacao', 'categoria', 'descricao'], 'required'],
            [['preco'], 'number'],
            [['nome', 'categoria'], 'string', 'max' => 255],
            ['descricao', 'string', 'max' => 3000],
            ['avaliacao', 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'preco' => 'Preço',
            'avaliacao' => 'Avaliação',
            'descricao' => 'Descrição',
        ];
    }

    public function getAvaliacaoMedia()
    {
        // Lógica para calcular a avaliação média
        $avaliacoes = Avaliacao::find()->where(['id_servico' => $this->id])->all();
        $totalAvaliacoes = count($avaliacoes);
        
        if ($totalAvaliacoes > 0) {
            $somaNotas = array_sum(array_column($avaliacoes, 'nota'));
            return $somaNotas / $totalAvaliacoes;
        } else {
            return 0;
        }
    }

    public function getColaborador()
    {
        return $this->hasOne(Colaborador::class, ['id' => 'colaborador_id']);
    }

    public function getPerguntas()
    {
        return $this->hasMany(Pergunta::class, ['id_servico' => 'id']);
    }
}
