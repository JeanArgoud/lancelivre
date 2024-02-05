<!-- views/avaliacao/editar.php -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */

$this->title = 'Editar Avaliação';
$this->params['breadcrumbs'][] = ['label' => 'Avaliações', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
$this->registerCssFile('@web/css/style.css');
?>
<div class="avaliacao-editar">

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
