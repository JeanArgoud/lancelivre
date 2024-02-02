<?php
use yii\helpers\Html;
?>

<div class='cartao-requisicao'>
    <div>
        <?= $model->usuario->nome ?>
    </div>
    <div>
        <?= $model->dataEnvioFormatada() ?>
    </div>
    <div>
        <?= $model->status() ?>
    </div>
    <?php
        if($model->data_resposta != null){
            echo $model->dataRespostaFormatada();
        }
    ?>    
    <div>
        <?= Html::a('Analisar Requisição', ['detalhes-requisicao','id_requisicao'=>$model->id],['class'=>'']);  ?>
    </div>
</div>

<style>
    .cartao-requisicao{
        border: solid 1px black;
    }
</style>