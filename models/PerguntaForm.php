<?php
// models/PerguntaForm.php

namespace app\models;

use yii\base\Model;

class PerguntaForm extends Model
{
    public $titulo;
    public $corpo;

    public function rules()
    {
        return [
            [['titulo', 'corpo'], 'required'],
            [['titulo'], 'string', 'max' => 255],
            [['corpo'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'titulo' => 'Título',
            'corpo' => 'Pergunta',
        ];
    }
}
