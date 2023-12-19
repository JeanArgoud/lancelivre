<?php 
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<div>
    <?php
        $form = ActiveForm::begin(['method' => 'post']);

        echo $form->field($novaConta, 'nome')->textInput()->label('Nome de Usuário'); 
        echo $form->field($novaConta, 'senha')->passwordInput()->label('Senha'); 
        
        echo Html::submitButton('Criar'); 

        ActiveForm::end();
    ?>
</div>