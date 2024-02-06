<?php
use yii\helpers\Html;
$this->registerCssFile('@web/css/tabelas.css');
?>

<table class="tabela-requisicoes">
    <thead>
        <tr>
            <th>Nome do Usuário</th>
            <th>Data de Envio</th>
            <th>Status</th>
            <th>Data da Resposta</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr class="cartao-requisicao">
            <td><?= $model->usuario->nome ?></td>
            <td><?= $model->dataEnvioFormatada() ?></td>
            <td><?= $model->status() ?></td>
            <td><?= $model->dataRespostaFormatada() ?></td>
            <td><?= Html::a('Analisar Requisição', ['detalhes-requisicao','id_requisicao'=>$model->id],['class'=>'analisar-button']) ?></td>
        </tr>
    </tbody>
</table>
