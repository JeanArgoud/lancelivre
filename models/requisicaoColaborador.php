<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;
use app\models\Conta;

class RequisicaoColaborador extends ActiveRecord
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
        if($this->data_envio == null){
            date_default_timezone_set('Etc/GMT+3');
            $this->data_envio = date('Y-m-d h:i:s A');
        }
        if($this->conta_id == null){
            $this->conta_id = Yii::$app->user->identity->id;
        }
        if($this->id == null){
            $this->id = $this->autoincrementarId();
        }
        if($this->data_resposta == null){
            date_default_timezone_set('Etc/GMT+3');
            $this->data_resposta = date('Y-m-d h:i:s A');
        }
        if($this->mensagem_aprovacao_lida == null){
            $this->mensagem_aprovacao_lida = false;
        }

        return parent::beforeSave($insert);
    }

    // Retorna um id 1 mais alto que o maior id que tem na tabela
    public function autoincrementarId()
    {
        $maiorId = RequisicaoColaborador::find()->orderBy(['id' => SORT_DESC])->one();
        if(!isset($maiorId)){
            return 1;
        }
        $novoId = $maiorId->id + 1;
        return $novoId;
    }

    // // Retorna a model do usuário que enviou a requisição
    // public function getUsuario()
    // {
    //     return conta::find()->where(['id'=>$this->conta_id])->one();        
    // }

    // Formata uma data para ser mostrada na tela
    public function formataData($data)
    {
        // Precisa ser feito ainda
        return $data; 
    }

    // Retorna a data de envio da requisição pelo usuário
    public function dataEnvioFormatada()
    {
        return $this->formataData($this->data_envio);
    }

    // Retorna a data que o admin respondeu a requisição
    public function dataRespostaFormatada()
    {
        $this->formataData($this->data_resposta);
    }

    // Retorna um texto dizendo se a requisição está aprovada ou não
    public function status()
    {
        if($this->aprovado === null){
            return 'Aguardando resposta';
        }
        else if($this->aprovado){
            return 'Requisição aprovada';
        }
        else{
            return 'Requisição recusada';
        }
    }

    // relacionamento de requisicaoColaborador com Conta
    public function getUsuario()
    {
        return $this->hasOne(Conta::class, ['id' => 'conta_id']);
    }
}