<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Consulta de Serviços por Colaborador';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-primary']) ?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'nome',
        'preco',
        'descricao',
        'data',
        // ... outras colunas ...
    ],
]) ?>
