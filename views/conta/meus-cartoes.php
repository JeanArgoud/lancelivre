<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Meus Cartões';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');

?> <h1><?= Html::encode($this->title) ?></h1> <?php

echo Html::a('Criar Cartão', ['conta/criar-cartao'], ['class' => 'btn btn-primary']);


echo GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $cartoes,
    ]),
    'columns' => [
        'id',
        'bandeira',
        'credito',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    $url = Url::to(['conta/editar-cartao', 'cartaoId' => $model->id]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', $url, [
                        'class' => 'btn btn-success btn-sm',
                        'title' => Yii::t('yii', 'Editar'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    $url = Url::to(['conta/deletar-cartao', 'cartaoId' => $model->id]);
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
