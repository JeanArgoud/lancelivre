<?php
namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Servico;

class ServicoSearch extends Servico
{
    public $nome; // Adicione o atributo para pesquisa

    public function rules()
    {
        return [
            [['nome'], 'safe'],
            [['categoria'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = Servico::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'nome', $this->nome]);
        $query->andFilterWhere(['categoria' => $this->categoria]);

        return $dataProvider;
    }
}
