<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<div>
    <div>
        <?= $requisicao->usuario->nome ?>
    </div>
    <div>
        <?= $requisicao->usuario->endereco ?>
    </div>
    <div>
        <?= $requisicao->usuario->escolaridade ?>
    </div>
    <div>
        <?= $requisicao->usuario->profissao ?>
    </div>
    <div>
        <?= $requisicao->dataEnvioFormatada() ?>
    </div>
    <div>
        <?= $requisicao->status() ?>
    </div>
    <?php if($requisicao->aprovado === null){ ?>
        <div>
        <?php
        $form = ActiveForm::begin(['method' => 'post']);
        echo $form->field($requisicao, 'aprovado')->radioList( [true => 'Sim', false => 'Não'] )->label('Aprovar?');
        echo $form->field($requisicao, 'mensagem')->textInput()->label('Mensagem de Resposta');
        echo Html::submitButton('Enviar'); 
        ActiveForm::end();
        ?>   
        </div> 
    <?php } else{ ?>
        <div>
            <?= $requisicao->dataRespostaFormatada() ?>
        </div>
    <?php } ?>
</div>