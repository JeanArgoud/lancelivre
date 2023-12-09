<?php

namespace app\models;

define("ADMIN", 1);  // Apenas 1, super usuário do sistema
define("GERENTE", 2);  // Pode realizar algumas operações administrativas do sistema
define("COLABORADOR", 3);   // Conta de uma empresa oferecendo um serviço
define("USUARIO", 4);     // Conta de um trabalhador procurando um serviço

class conta extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    // Compara se a senha digitada é a mesma que está no banco
    public function validaSenha($senha)
    {
        return $this->senha === $senha;
    }
}