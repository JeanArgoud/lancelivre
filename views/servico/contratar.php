<!-- views/servico/contratar.php -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Contratar Serviço';
$this->params['breadcrumbs'][] = ['label' => 'Serviços', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');

?>

<div class="servico-contratar">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_servico')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'id_cartao')->dropDownList($cartoes) ?>

    <div class="form-group">
        <?= Html::submitButton('Contratar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
