<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Serviço';
$this->params['breadcrumbs'][] = ['label' => 'Meus Serviços', 'url' => ['servico/meus-servicos']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'preco')->textInput(['maxlength' => true]) ?>
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

<!-- Outros campos do formulário, se necessário -->

<div class="form-group">
    <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
