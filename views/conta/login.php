<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->registerCssFile('@web/css/style.css');
?>

<style>
   /* Cor da checkbox quando não marcada */
    .custom-checkbox .custom-control-input:not(:checked) ~ .custom-control-label::before {
        background-color: #fff; /* Cor de fundo para o estado não marcado */
        border-color: #000; /* Cor da borda para o estado não marcado */
    }

    /* Cor da checkbox quando marcada */
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #D1DAD0; /* Sua cor desejada para o fundo */
        border-color: #000; /* Sua cor desejada para a borda */
    }

    /* Cor do ícone da checkbox (a "check") quando marcada */
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::after {
        color: #000; /* Cor do ícone "check" */
        border-color: #000;
    }

    /* Estilo específico para manter a cor do texto do label constante */
    .custom-checkbox .custom-control-label {
        color: #000 !important; /* Mantém o texto preto */
    }

    .custom-checkbox .custom-control-input:focus ~ .custom-control-label::before {
        box-shadow: none !important; /* Remove a sombra */
        border-color: #000 !important; /* Define uma cor de borda específica, ou use a cor padrão */
    }


</style>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($conta, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($conta, 'senha')->passwordInput() ?>

    <?= $form->field($conta, 'rememberMe')->checkbox([
        'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?>

    <div class="form-group">
        <div class="offset-lg-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
