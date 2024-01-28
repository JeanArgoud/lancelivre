<?php 
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<div>
    <?php
        $form = ActiveForm::begin(['method' => 'post']);

        echo $form->field($conta, 'endereco')->textInput(['autofocus' => true])->label('Endereço'); 
        echo $form->field($conta, 'escolaridade')->textInput()->label('Escolaridade'); 
        echo $form->field($conta, 'profissao')->textInput()->label('Profissão');
        
        echo Html::submitButton('Enviar'); 

        ActiveForm::end();
    ?>
</div>