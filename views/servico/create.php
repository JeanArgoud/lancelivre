<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->registerCssFile('@web/css/style.css');
?>

<div class="servico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'endereco')->textInput() ?>

    <?= $form->field($model, 'categoria')->dropDownList([
        'Geral' => 'Geral',
        'Programação' => 'Programação',
        'Design Gráfico' => 'Design Gráfico',
        'Marketing Digital' => 'Marketing Digital',
        'Escrita' => 'Escrita',
        'Negócios' => 'Negócios',
        'Música e Áudio' => 'Música e Áudio',
        'Fotografia' => 'Fotografia',
    ]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6, 'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
