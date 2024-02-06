<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->registerCssFile('@web/css/style.css');
$this->registerCssFile('@web/css/tabelas.css');
?>

<div>
    <table class="tabela-requisicoes">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Escolaridade</th>
                <th>Profissão</th>
                <th>Data de Envio</th>
                <th>Status</th>
                <th>Data Resposta</th>
                <th>Documentos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $requisicao->usuario->nome ?></td>
                <td><?= $requisicao->usuario->endereco ?></td>
                <td><?= $requisicao->usuario->escolaridade ?></td>
                <td><?= $requisicao->usuario->profissao ?></td>
                <td><?= $requisicao->dataEnvioFormatada() ?></td>
                <td><?= $requisicao->status() ?></td>
                <td> <?= $requisicao->dataRespostaFormatada() ?></td>
                <td><?= Html::a('Visualizar Documentação', ['visualizar-documentos'],['class'=>'visualizar-documentos-button']) ?></td>
                

            </tr>
        </tbody>
    </table>

    <?php if($requisicao->aprovado === null){ ?>
        <div>
        <?php
        $form = ActiveForm::begin(['method' => 'post']);
        echo $form->field($requisicao, 'aprovado')->radioList( [true => 'Sim', false => 'Não'] )->label('Aprovar?');
        echo $form->field($requisicao, 'mensagem')->textInput()->label('Mensagem de Resposta');
        echo Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'enviar-button']);
        ActiveForm::end();
        ?>   
        </div> 
    <?php } ?>
</div>