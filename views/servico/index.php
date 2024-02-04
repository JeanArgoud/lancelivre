<?php
use yii\helpers\Html;
use kartik\rating\StarRating;
use yii\widgets\ActiveForm;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;

$this->title = 'Serviços';
$this->params['breadcrumbs'][] = $this->title;

?>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

<style>
    /* Adicione um estilo de CSS para a div que contém os cards */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between; /* ou flex-start, flex-end, center, etc. dependendo do alinhamento desejado */
        margin: -5px; /* Ajuste conforme necessário */
    }

    .card {
        width: calc(33.33% - 10px); /* Ajuste a largura conforme necessário */
        margin: 5px; /* Ajuste conforme necessário */
        background-color: #D1DAD0;
        border-radius: 25px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .card-body {
        
    }

    .card-title {
        color: black;
    }

    .card-description {
        max-height: 5em; /* Defina a altura máxima em até três linhas */
        overflow: hidden; /* Esconde o texto que ultrapassar a altura máxima */
        text-overflow: ellipsis; /* Adiciona "..." ao final do texto que ultrapassar a altura máxima */
    }

    .card-price {
        color: black;
    }

    .search-bar {
        display: flex;
    }

    .search-icon {
        color: white;
        background-color: #69A989;
        border-radius: 25px;
    }

    .search {
        display: flex;
        justify-content: center;
        align-items: center;
     }
  
    .search-input{
        width: 200px; /* Ajuste a largura conforme necessário */
        padding: 8px; /* Ajuste o preenchimento conforme necessário */
        border: 1px solid #ccc; /* Cor da borda */
        border-radius: 20px; /* Raio da borda para torná-la arredondada */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave para efeito tridimensional */
        outline: none; /* Remover a borda de foco padrão */
    }
  
    .search-button {
        border: none;
        border-radius: 50%;
        background-color: #69A989;
        color: white;
    }
</style>


<!-- Adicione a barra de pesquisa -->
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => ['class' => 'form-inline mb-2 search'],
]); ?>
    <?= $form->field($searchModel, 'nome')->textInput(['class' => 'search-input', 'placeholder' => 'Pesquisar por nome'])->label(false) ?>
    <?= Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn search-button']) ?>
<?php ActiveForm::end(); ?>

<?php
// Adicione a barra de navegação expandida para mostrar categorias
NavBar::begin([
    'options' => [
        'class' => 'navbar navbar-expand-lg navbar-light bg-light', // Adicione a classe fixed-top para tornar a barra de navegação fixa no topo
    ],
]);

echo '<div class="container">'; // Adicione um container para envolver os itens da barra de navegação

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'], // Adicione ml-auto para alinhar os itens à direita
    'items' => [
        ['label' => 'Geral', 'url' => ['servico/index', 'categoria' => 'Geral'], 'options' => ['class' => 'mr-3']],
        ['label' => 'Programação', 'url' => ['servico/index', 'categoria' => 'Programação'], 'options' => ['class' => 'mr-3']],
        ['label' => 'Design Gráfico', 'url' => '#', 'options' => ['class' => 'mr-3']],
        ['label' => 'Marketing Digital', 'url' => '#', 'options' => ['class' => 'mr-3']],
        ['label' => 'Escrita', 'url' => '#', 'options' => ['class' => 'mr-3']],
        ['label' => 'Negócios', 'url' => '#', 'options' => ['class' => 'mr-3']],
        ['label' => 'Música e Áudio', 'url' => '#', 'options' => ['class' => 'mr-3']],
        ['label' => 'Fotografia', 'url' => '#', 'options' => ['class' => 'mr-3']],
    ],
]);

echo '</div>'; // Feche o container

NavBar::end();
?>

<p></p>

<div class="card-container">
    <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="card">
            <div class="card-body">
                <h5><?= Html::a(Html::encode($model->nome), ['view', 'id' => $model->id], ['class' => 'card-title']) ?></h5>
                <div class="card-description">
                    <p><?= nl2br(Html::encode($model->descricao)) ?></p>
                </div>
                <?= StarRating::widget([
                    'name' => 'rating_' . $model->id,
                    'value' => $model->getAvaliacaoMedia(),
                    'pluginOptions' => [
                        'displayOnly' => true,
                        'showClear' => false,
                        'size' => 'xs',
                    ],
                ]); ?>
                <p class="card-price"><?= Html::encode($model->preco) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
