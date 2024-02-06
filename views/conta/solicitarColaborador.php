<?php 
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
$this->registerCssFile('@web/css/style.css');
?>

<div>
    <?php
    $resposta = $conta->respostaRequisicao();
    if($resposta === null || is_string($resposta)){
        if(is_string($resposta)){
            echo "<div>Resposta recebida: ".$resposta."</div>";
        }

        $form = ActiveForm::begin(['method' => 'post']);
    
        echo $form->field($conta, 'endereco')->textInput(['autofocus' => true])->label('Endereço'); 
        echo $form->field($conta, 'escolaridade')->textInput()->label('Escolaridade'); 
        echo $form->field($conta, 'profissao')->textInput()->label('Profissão');
        
        echo Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'enviar-button']); 
    
        ActiveForm::end();
    }
    else if($resposta == false){
        echo "<div>A sua requisição ainda não foi respondida.</div>";
    }        
    ?>
</div>