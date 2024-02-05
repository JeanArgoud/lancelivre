<?php 
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
$this->registerCssFile('@web/css/style.css');
?>

<div>
    <?php
        if($contaAdmin){
            echo "<div><b>Você está criando uma conta de administrador!</b></div>";
        }

        $form = ActiveForm::begin(['method' => 'post']);

        echo $form->field($novaConta, 'nome')->textInput(['autofocus' => true])->label('Nome de Usuário'); 
        echo $form->field($novaConta, 'senha')->passwordInput()->label('Senha'); 
        echo $form->field($novaConta, 'email')->textInput()->label('Email');
        
        echo Html::submitButton('Criar', ['class' => 'btn btn-primary', 'name' => 'criar-button']);

        ActiveForm::end();
    ?>
</div>