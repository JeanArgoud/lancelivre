<?php
namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;
use yii\db\Expression;

class CartaoCredito extends ActiveRecord
{
    public function rules()
    {
        return [
            [['id_usuario', 'bandeira', 'credito'], 'required'],
            [['id_usuario', 'credito'], 'number'],
            ['bandeira', 'string'],
        ];
    }

    public static function tableName()
    {
        return 'cartao_credito';
    }
    // models/CartaoCredito.php

    public static function depositarValor($cartaoUsuarioId, $cartaoColaboradorId, $valor)
    {
        $cartaoUsuario = self::findOne($cartaoUsuarioId);
    
        // verifica saldo
        if ($cartaoUsuario && $cartaoUsuario->credito >= $valor) {
            $transaction = self::getDb()->beginTransaction();
    
            try {
                // Deduzir o valor do crédito do usuário
                $cartaoUsuario->credito -= $valor;
                $cartaoUsuario->save();
    
                // Acrescentar o valor à conta do colaborador
                self::updateAll(
                    ['credito' => new Expression("credito + $valor")],
                    ['id' => $cartaoColaboradorId]
                );
    
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
        }
    
        return false;
    }

    public static function getTodosCartoes($userId)
    {
        return CartaoCredito::find()
            ->where(['id_usuario' => $userId])
            ->all();
    }
}
