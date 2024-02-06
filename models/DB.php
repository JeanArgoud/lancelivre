<?php

namespace app\models;

class DB
{
    public static function consultaPorColaborador($colaboradorId)
    {
        return Colaborador::find()
            ->where(['id' => $colaboradorId])
            ->all();
    }

    public static function consultaPorUsuario($userId)
    {
        return conta::findOne($userId);
    }
    // Outras consultas podem ser adicionadas conforme necessário
}
