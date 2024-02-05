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
        justify-content: flex-start; /* ou flex-start, flex-end, center, etc. dependendo do alinhamento desejado */
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

    .form-inline {
        display: flex; /* Confirma que estamos utilizando Flexbox */
        width: 100%; /* Ocupa toda a largura do seu container pai */
        flex-wrap: nowrap; /* Previne a quebra de linha dos itens internos */
    }

    .form-inline .form-group {
        flex-grow: 1; /* Faz o .form-group crescer para ocupar o espaço disponível */
        width: 90%; /* Garante que o .form-group tente ocupar toda a largura */
        margin-right: 8px; /* Opcional: Adiciona um espaço à direita, se necessário */
        height: 40px;
    }

    .form-inline .form-group .search-input {
        width: 100%; /* Faz a barra de pesquisa ocupar toda a largura do .form-group */
        border-radius: 20px; /* Ajuste o valor conforme desejar para as bordas arredondadas */
        height: 100%;
        padding-left: 8px;
        border-style: solid;
        border-width: 2px;
        border-color: #D1DAD0; 
    }

    .form-inline .search-button {
        width: 40px; /* Define a largura do botão */
        height: 40px; /* Define a altura do botão para igualar a largura, criando um quadrado */
        border-radius: 50%; /* Faz o quadrado se tornar um círculo */
        padding: 0; /* Ajuste ou remova o padding para garantir que o ícone fique centralizado */
        display: flex; /* Utiliza flexbox para centralizar o conteúdo (ícone ou texto) dentro do botão */
        justify-content: center; /* Centraliza o conteúdo horizontalmente */
        align-items: center; /* Centraliza o conteúdo verticalmente */
        background-color: #D1DAD0; 
        border: none; 
    }

    .collapse .container {
        justify-content: center;
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
        ['label' => 'Design Gráfico', 'url' => ['servico/index', 'categoria' => 'Design Gráfico'], 'options' => ['class' => 'mr-3']],
        ['label' => 'Marketing Digital', 'url' => ['servico/index', 'categoria' => 'Marketing Digital'], 'options' => ['class' => 'mr-3']],
        ['label' => 'Escrita', 'url' => ['servico/index', 'categoria' => 'Escrita'], 'options' => ['class' => 'mr-3']],
        ['label' => 'Negócios', 'url' => ['servico/index', 'categoria' => 'Negócios'], 'options' => ['class' => 'mr-3']],
        ['label' => 'Música e Áudio', 'url' => ['servico/index', 'categoria' => 'Música e Áudio'], 'options' => ['class' => 'mr-3']],
        ['label' => 'Fotografia', 'url' => ['servico/index', 'categoria' => 'Fotografia'], 'options' => ['class' => 'mr-3']],
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
