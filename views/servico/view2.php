<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\conta;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Servico */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Serviços', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .service-view {
        max-width: 800px;
        margin: 0 auto;
    }

    .service-content {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .service-description {
        flex: 1;
        margin-right: 20px;
    }

    .service-details {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .price-box {
        background-color: #f0f0f0;
        padding: 15px;
        border-radius: 5px;
    }

    .contact-button {
        margin-top: 10px;
    }
</style>

<div class="service-view">
    <h1><?= Html::encode($model->title) ?></h1>

    <div class="service-content">
        <div class="service-description">
            <p><?= Html::encode($model->descricao) ?></p>
        </div>

        <div class="service-details">
            <div class="price-box">
                <h3>Preço do Serviço</h3>
                <p><?= Yii::$app->formatter->asCurrency($model->preco) ?></p>
            </div>

            <div class="contact-button">
                <?= Html::a('Entrar em Contato', ['contato', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <div class="collaborator-info">
        <h2>Informações do Colaborador</h2>
        <p><?= Html::encode($collaborator->name) ?></p>
        <!-- Adicione outras informações do colaborador conforme necessário -->
    </div>

    <div class="service-reviews">
        <h2>Avaliações</h2>
        <!-- Adicione lógica para exibir as avaliações -->
    </div>

    <div class="service-questions">
        <h2>Perguntas</h2>
        <!-- Adicione lógica para exibir as perguntas -->
    </div>
</div>