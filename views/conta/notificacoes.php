<!-- views/site/notificacoes.php -->

<?php
use yii\helpers\Html;

$this->title = 'Notificações';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="notificacoes-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Inclua a view parcial _notificacao -->
    <?= $this->render('_notificacao', ['notificacoes' => $notificacoes]) ?>
</div>
