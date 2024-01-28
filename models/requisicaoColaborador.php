<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;

class requisicaoColaborador extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['mensagem'], 'string', 'message' => 'A justificativa de rejeição precisa ser um texto.'],            
        ];
    }

    // Executa antes do comando ->save() para definir algumas variáveis
    public function beforeSave($insert)
    {
        date_default_timezone_set('Etc/GMT+3');
        $this->data = date('Y-m-d h:i:s A');
        $this->conta_id = Yii::$app->user->identity->id;
        $this->id = $this->autoincrementarId();

        return parent::beforeSave($insert);
    }

    // Retorna um id 1 mais alto que o maior id que tem na tabela
    public function autoincrementarId()
    {
        $maiorId = requisicaoColaborador::find()->orderBy(['id' => SORT_DESC])->one();
        if(!isset($maiorId)){
            return 1;
        }
        $novoId = $maiorId->id + 1;
        return $novoId;
    }
}