<?php
// models/Canal.php

namespace app\models;

use yii\db\ActiveRecord;

class Canal extends ActiveRecord
{
    public static function tableName()
    {
        return 'canal';
    }

    // models/Canal.php

    public static function findOrCreate($idUsuario, $idColaborador)
    {
        $canal = self::find()
            ->andWhere(['id_usuario' => $idUsuario, 'id_colaborador' => $idColaborador])
            ->orWhere(['id_usuario' => $idColaborador, 'id_colaborador' => $idUsuario])
            ->one();

        if (!$canal) {
            $canal = new Canal([
                'id_usuario' => $idUsuario,
                'id_colaborador' => $idColaborador,
            ]);

            $canal->save();
        }

        return $canal;
    }

}
