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
            [['nome', 'senha'], 'required'],
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
        if ($this->validate()) {            
            if($conta = $this->getConta(null, $this->nome)){
                if($conta->validaSenha($conta, $this->senha)){
                    return Yii::$app->user->login($conta, $this->rememberMe ? 3600*24*30 : 0);
                }
            }
        }
        return false;
    }

    // Retorna um usuário de acordo com seu nome ou id
    public function getConta($id=null,$nome=null)
    {
        $query = conta::find();
        if($id != null){
            $query->where(['id'=>$id]);
        }
        else if($nome != null){
            $query->where(['nome'=>$nome]);
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
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * Função obrigatória de ter
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
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


}