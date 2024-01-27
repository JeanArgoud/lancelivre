<!-- views/servico/_mensagem.php -->

<?php

use yii\helpers\Html;

/* @var $model app\models\Mensagem */

?>


<style>
    .mensagem-container {
        position: relative;
        background-color: #f0f0f0; /* Cor de fundo */
        border-radius: 10px; /* Bordas arredondadas */
        padding: 10px; /* Espaçamento interno */
        margin-bottom: 10px; /* Espaçamento inferior entre as mensagens */
    }

    .mensagem-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px; /* Espaçamento inferior entre o cabeçalho e o corpo da mensagem */
    }

    .mensagem-nome {
        font-weight: bold;
    }

    .mensagem-body {
        margin-bottom: 10px; /* Espaçamento inferior entre o corpo da mensagem e o rodapé */
    }

    .mensagem-footer {
        position: absolute;
        bottom: 0;
        right: 10px; /* Margem à direita para a data */
        color: #888; /* Cor cinza mais fraca */
        font-size: 12px; /* Tamanho menor */
    }
</style>

<div class="mensagem-container">
    <div class="mensagem-header">
        <span class="mensagem-nome"><?= Html::encode($model->enviado_por) ?></span>
    </div>
    <div class="mensagem-body">
        <p><?= Html::encode($model->texto) ?></p>
    </div>
    <div class="mensagem-footer">
        <span class="mensagem-data"><?= Yii::$app->formatter->asDatetime($model->data_envio) ?></span>
    </div>
</div>
