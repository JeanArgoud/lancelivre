<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;

define("ADMIN", 1);  // Apenas 1, super usuário do sistema
define("COLABORADOR", 2);   // Conta de uma empresa oferecendo um serviço
define("USUARIO", 2);     // Conta de um trabalhador procurando um serviço

class conta extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $rememberMe = true;
    public $authKey;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['nome', 'senha', 'email','tipo'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    // Compara se a senha digitada é a mesma que está no banco
    public function validaSenha($conta,$senha)
    {
        return $conta->senha === $senha;
    }

     /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {                   
        if($conta = $this->getConta(null, $this->email)){
            if($conta->validaSenha($conta, $this->senha)){
                return Yii::$app->user->login($conta, $this->rememberMe ? 3600*24*30 : 0);
            }
        }        
        return false;
    }

    // Retorna um usuário de acordo com seu nome ou id
    public static function getConta($id=null,$email=null)
    {
        $query = conta::find();
        if($id != null){
            $query->where(['id'=>$id]);
        }
        else if($email != null){
            $query->where(['email'=>$email]);
        }
        return $query->one();             
    }

    // retorna o id do usuário
    public function getId()
    {
        return $this->id;
    }

    /**
     * Função obrigatória de ter
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Função obrigatória de ter
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

      /**
       * Função obrigatória de ter
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Função obrigatória de ter
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    // Código exercutado antes de salvar um dado no banco
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->id = $this->autoincrementarId();
            $this->authKey = Yii::$app->security->generateRandomString();
        }
        return parent::beforeSave($insert);
    }

    // Retorna um id 1 mais alto que o maior id que tem na tabela
    public function autoincrementarId()
    {
        $contaMaiorId = conta::find()->orderBy(['id' => SORT_DESC])->one();
        if(!isset($contaMaiorId)){
            return 1;
        }
        $novoId = $contaMaiorId->id + 1;
        return $novoId;
    }

    // Procura se este email é único ou existe já outra conta com este email 
    public function emailUnico()
    {
        if($conta = $this->getConta(null, $this->email)){
            return false;
        }
        else{
            return true;
        }
    }

     // Retorna todos os serviços de um colaborador
    public function getTodosServicos($colaboradorId)
    {
        return Servico::find()
            ->where(['colaborador_id' => $colaboradorId])
            ->all();
    }

    // Define se a nova conta é de administrador ou usuário
    public function defineTipo($contaAdmin, $token)
    {
        if($contaAdmin){
            $this->tipo = ADMIN;
            AdminToken::gastaToken($token);
        }
        else{
            $this->tipo = USUARIO;
        }
    }

    // checa se o usuário é administrador
    public function contaDeAdmin()
    {
        if($this->tipo == ADMIN){
            return true;
        }
        else{
            return false;
        }
    }

    // Checa se o usuário já foi aprovado como colaborador
    public function requisicaoColaboradorAprovada()
    {
        $existe_aprovacao = RequisicaoColaborador::find()->where(['conta_id'=>$this->id])->andWhere(['aprovado'=>true])->one();
        if($existe_aprovacao){
            return true;
        }
        else{
            return false;
        }
    }

    // Checa se a requisição do usuário foi respondida ou não
    // Se tiver sido respondida, retorna a 'string' da resposta
    // Se não tiver sido respondida, retorna 'false'
    // Se Não existir requisição nenhuma sendo aguardada, retorna 'null'
    public function respostaRequisicao()
    {
        $requisicao = RequisicaoColaborador::find()->where(['conta_id'=>$this->id])->andWhere(['or','aprovado=false','aprovado=null'])->one();
        if(!$requisicao){
            return null;
        }
        else if($requisicao->aprovado === null){
            return false;
        }
        else{
            return $requisicao->mensagem;
        }
    }

    // Caso o usuário tenha sido aprovado como um colaborador, retorna a mensagem de leitura única que o admin enviou
    public function possuiMensagemAprovacaoColaborador()
    {
        $requisicao_aprovada = RequisicaoColaborador::find()->where(['conta_id'=>$this->id])->andWhere(['aprovado'=>true])->one();
        if($requisicao_aprovada){
            if($requisicao_aprovada->mensagem_aprovacao_lida == false){
                $requisicao_aprovada->mensagem_aprovacao_lida = true;
                $requisicao_aprovada->save();
                return $requisicao_aprovada->mensagem;
            }
        }else{
            return false;
        }
    }
}