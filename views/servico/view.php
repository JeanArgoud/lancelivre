<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\conta;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Servico */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Serviços', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<style>
    .avaliacao-container {
        position: relative;
        background-color: #f0f0f0; /* Cor de fundo */
        border-radius: 10px; /* Bordas arredondadas */
        padding: 10px; /* Espaçamento interno */
        margin-bottom: 10px; /* Espaçamento inferior entre as mensagens */
    }

    .avaliacao-content {
        /* Estilos adicionais para o conteúdo da avaliação */
    }

    .pergunta-container {
        border: 1px solid #ccc;
        margin-bottom: 10px;
    }

    .pergunta-header {
        background-color: #f0f0f0;
        padding: 5px;
        display: flex;
        justify-content: space-between;
    }

    .pergunta-body {
        padding: 10px;
        display: none; /* Esconda o corpo da pergunta inicialmente */
    }
    .mensagem-container {
        margin-top: 10px;
    }

    .mensagem-input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        margin-bottom: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical; /* Permite redimensionar verticalmente se necessário */
    }

    .btn-enviar-mensagem {
        padding: 8px 12px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-enviar-mensagem:hover {
        background-color: #0056b3;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Seletor para todos os contêineres de pergunta
        var perguntas = document.querySelectorAll('.pergunta-container');

        perguntas.forEach(function (pergunta) {
            var header = pergunta.querySelector('.pergunta-header');
            var body = pergunta.querySelector('.pergunta-body');

            header.addEventListener('click', function () {
                // Alternar a visibilidade do corpo da pergunta
                body.style.display = body.style.display === 'none' ? 'block' : 'none';
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        // Adicione um ouvinte de evento para cada botão de enviar
        document.querySelectorAll(".enviar-mensagem").forEach(function (btnEnviar) {
            btnEnviar.addEventListener("click", function () {
                // Encontre a caixa de mensagem associada
                var mensagemContainer = btnEnviar.closest(".pergunta-container").querySelector(".mensagem-input");

                // Obtenha o valor da mensagem
                var mensagem = mensagemContainer.value;

                // Atualize o campo de pergunta com a nova mensagem
                // (se já houver uma pergunta, adicione uma quebra de linha antes da nova mensagem)
                mensagemContainer.closest(".pergunta-container").querySelector(".pergunta-body").textContent +=
                    (mensagemContainer.closest(".pergunta-container").querySelector(".pergunta-body").textContent.trim() !== "" ? "\n" : "") +
                    mensagem;

                // Limpe a caixa de mensagem
                mensagemContainer.value = "";
            });
        });
});
</script>

<div class="servico-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Contatar', ['contatar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Contratar', ['contratar', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Avaliar', ['avaliar', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'preco',
            [
                'label' => 'Avaliação',
                'value' => $model->getAvaliacaoMedia(). ' estrelas', // Supondo que 'avaliacao' seja um campo numérico representando a avaliação
            ],
            'descricao:ntext',
            [
                'label' => 'Colaborador',
                'value' => $model->colaborador->nome, // Substitua 'nome' pelo atributo real do colaborador
            ],
        ],
    ]) ?>

    <h2>Avaliações</h2>
    
    <?php if(!empty($avaliacoes)): ?>
        <?php foreach ($avaliacoes as $avaliacao): ?>
            <div class="avaliacao-container">
                <div class="avaliacao-content">
                    <p><strong><?= Html::encode($avaliacao->conta->nome) ?></strong></p>
                    <?= StarRating::widget([
                        'name' => 'avaliacao-' . $avaliacao->id, // Substitua por um identificador único
                        'value' => $avaliacao->nota,
                        'pluginOptions' => [
                            'displayOnly' => true,
                            'size' => 'xs',
                            'showClear' => false,
                            // Outras opções conforme necessário
                        ],
                    ]); ?>
                    <p><?= Html::encode($avaliacao->comentario) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        Não há avaliações.
    <?php endif ?>

    <h2>Perguntas</h2>

    <?php $currentUserIsCollaborator = Yii::$app->user->identity->id === $model->colaborador_id; ?>
    <!-- Exibição das perguntas -->
    <?php if(!empty($model->perguntas)): ?>
        <?php foreach ($model->perguntas as $pergunta): ?>
            <div class="pergunta-container">
                <?php if ($pergunta->usuario): ?>
                    <div class="pergunta-header">
                        <strong><?= $pergunta->usuario->nome ?></strong>
                        <span><?= $pergunta->titulo ?></span>
                        <span><?= Yii::$app->formatter->asDatetime($pergunta->data) ?></span>
                    </div>
                <?php endif; ?>
                <div class="pergunta-body">
                    <?= $pergunta->pergunta ?>
                    <?php if (!empty($pergunta->resposta)): ?>
                        <div class="resposta">
                            <strong>Resposta do Colaborador:</strong> <?= $pergunta->resposta ?>
                        </div>
                    <?php endif; ?>
                    <!-- Formulário para enviar resposta -->
                    <?php if($pergunta->resposta == null && $currentUserIsCollaborator): ?>
                        <?php $form = ActiveForm::begin([
                            'options' => ['class' => 'resposta-container'],
                            'action' => ['servico/resposta-pergunta', 'id' => $model->id],
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => false,
                        ]); ?>
                        <?= $form->field($pergunta, 'resposta')->textarea(['placeholder' => 'Digite sua resposta']) ?>
                        <?= Html::hiddenInput('perguntaId', $pergunta->id) ?> <!-- Adicione o ID da pergunta como campo oculto -->
                        <?= Html::submitButton('Enviar Resposta', ['class' => 'btn btn-primary btn-enviar-resposta']) ?>
                        <?php ActiveForm::end(); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>  
        Não há perguntas.
    <?php endif ?>
    
    <h3>Envie sua pergunta ao colaborador</h3>

    <?php if (!Yii::$app->user->isGuest): ?>
        <?php $form = ActiveForm::begin([
            'action' => ['servico/enviar-pergunta', 'id' => $model->id],
            'options' => ['class' => 'form-pergunta'],
        ]); ?>

        <?= $form->field($perguntaForm, 'titulo')->textInput(['maxlength' => true])->label('Título'); ?>
        <?= $form->field($perguntaForm, 'corpo')->textarea(['rows' => 4, 'placeholder' => 'Envie uma pergunta ao colaborador'])->label('Pergunta'); ?>

        <?= Html::submitButton('Enviar Pergunta', ['class' => 'btn btn-primary']); ?>

        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>
