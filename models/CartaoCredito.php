<?php
namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;

class CartaoCredito extends \yii\db\ActiveRecord
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

    public static function getTodosCartoes($userId)
    {
        return CartaoCredito::find()
            ->where(['id_usuario' => $userId])
            ->all();
    }
}
