<?php

namespace app\models;

use yii\base\Model;

class ServicoForm extends Model
{
    public $nome;
    public $preco;
    public $categoria;
    public $descricao;
    public $endereco;
    // Adicione outros atributos conforme necessário

    public function rules()
    {
        return [
            [['nome', 'preco', 'categoria', 'descricao'], 'required'],
            [['nome', 'categoria','endereco'], 'string', 'max' => 255],
            ['descricao', 'string', 'max' => 3000],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'preco' => 'Preço',
            'categoria' => 'Categoria',
            'descricao' => 'Descrição',
            'endereco' => 'Endereço'
            // Adicione rótulos adicionais conforme necessário
        ];
    }
}
