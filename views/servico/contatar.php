<!-- views/servico/contatar.php -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Servico */
/* @var $canal app\models\Canal */
/* @var $mensagemModel app\models\Mensagem */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contatar ' . $model->colaborador->nome;
$this->params['breadcrumbs'][] = ['label' => 'Serviços', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
?>

<div class="servico-contatar">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Exibir mensagens anteriores -->
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_mensagem',
        'layout' => "{items}\n{pager}",
    ]) ?>

    <!-- Exibir o formulário para enviar mensagens -->
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($mensagemModel, 'texto')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
