<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;

class AdminToken extends ActiveRecord
{
    // Valida se um token recebido está no banco e ainda não foi usado, registrando ele como usado em seguida
    public function validaToken($token)
    {
        $adminToken = AdminToken::find()->where(['token'=>$token])->andWhere(['usado'=>false])->one();
        if($adminToken){            
            return true;
        }
        else{
            return false;
        }
    }

    // Tokens de criar administradores são de uso único, então deve ser inutilizado após uso
    public function gastaToken($token)
    {
        $adminToken = AdminToken::find()->where(['token'=>$token])->andWhere(['usado'=>false])->one();
        $adminToken->usado = true;
        date_default_timezone_set('Etc/GMT+3');
        $adminToken->data_usado = date('Y-m-d h:i:s A');
        $adminToken->save($adminToken);
    }
}