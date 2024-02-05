<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Meus Serviços';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');

?> <h1><?= Html::encode($this->title) ?></h1> <?php

if(Yii::$app->user->identity->tipo == COLABORADOR){
    echo Html::a('Oferecer Serviço', ['servico/create'], ['class' => 'btn btn-primary']);
}

echo GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $servicos,
    ]),
    'columns' => [
        'id',
        'nome',
        'preco',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    $url = Url::to(['servico/edit', 'serviceId' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', $url, [
                        'class' => 'btn btn-success btn-sm',
                        'title' => Yii::t('yii', 'Editar'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    $url = Url::to(['servico/delete', 'serviceId' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span> Deletar', $url, [
                        'class' => 'btn btn-danger btn-sm',
                        'title' => Yii::t('yii', 'Deletar'),
                        'data-confirm' => Yii::t('yii', 'Tem certeza que deseja deletar este item?'),
                        'data-method' => 'post',
                    ]);
                },
            ],
        ],
    ],
]);
