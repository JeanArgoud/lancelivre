<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\rating\StarRating;
// on your view layout file
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);
?>

<div class="card" style="width: 200px; margin-right: 10px;">
    <div class="card-body">
        <h5 class="card-title"><?= Html::a(Html::encode($model->nome), ['view', 'id' => $model->id]) ?></h5>
        <p class="card-text"><?= Html::encode($model->preco) ?></p>
        <?= StarRating::widget([
            'name' => 'rating_' . $model->id,
            'value' => $model->avaliacao,
            'pluginOptions' => [
                'displayOnly' => true,
                'showClear' => false,
                'size' => 'xs',
            ],
        ]); ?>
    </div>
</div>
