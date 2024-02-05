<!-- views/conta/createCartao.php -->
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Adicionar Cartão de Crédito';
$this->params['breadcrumbs'][] = ['label' => 'Minha Conta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="cartao-credito-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bandeira')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'credito')->textInput(['maxlength' => true]) ?>
    <!-- Adicione mais campos conforme necessário -->

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
