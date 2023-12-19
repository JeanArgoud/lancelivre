<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;

define("ADMIN", 1);  // Apenas 1, super usuário do sistema
define("GERENTE", 2);  // Pode realizar algumas operações administrativas do sistema
define("COLABORADOR", 3);   // Conta de uma empresa oferecendo um serviço
define("USUARIO", 4);     // Conta de um trabalhador procurando um serviço

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
            [['nome', 'senha', 'email'], 'required'],
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
    public function getConta($id=null,$email=null)
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

    // Código executado antes da validação das propriedades da model
    public function beforeValidate()
    {
        $this->tipo = USUARIO;
        if (!($this->tipo == USUARIO || $this->tipo == COLABORADOR)) {
            $this->addError('tipo', 'É obrigatório escolher o tipo de conta.');
        }

        return parent::beforeValidate();
    }

    // Código exercutado antes de salvar um dado no banco
    public function beforeSave($insert)
    {
        $this->id = $this->autoincrementarId();
        if ($insert) {
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
}