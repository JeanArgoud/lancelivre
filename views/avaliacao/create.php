<!-- views/avaliacao/create.php -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */

$this->title = 'Avaliar Serviço';
$this->params['breadcrumbs'][] = ['label' => 'Serviços', 'url' => ['servico/index']];
$this->params['breadcrumbs'][] = ['label' => $model->servico->nome, 'url' => ['servico/view', 'id' => $model->id_servico]];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
?>

<div class="avaliacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nota')->widget(\kartik\rating\StarRating::classname(), [
        'pluginOptions' => [
            'showClear' => false,
            'size' => 'xs',
        ],
    ]); ?>

    <?= $form->field($model, 'comentario')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
