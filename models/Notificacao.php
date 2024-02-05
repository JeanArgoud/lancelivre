<?php
// models/Notificacao.php

namespace app\models;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Notificacao extends ActiveRecord
{
    // Defina aqui os atributos e as regras de validação, se necessário
    public function rules()
    {
        return[
            [['id_usuario', 'mensagem', 'data'], 'required'],
        ];
    }
    public static function tableName()
    {
        return 'notificacao'; // Certifique-se de que o nome da tabela esteja correto
    }

    public static function enviarNotificacao($idUsuario, $mensagem)
    {
        $notificacao = new Notificacao([
            'id_usuario' => $idUsuario,
            'mensagem' => $mensagem,
            'data' => new Expression('NOW()'),
        ]);

        return $notificacao->save();
    }
}
