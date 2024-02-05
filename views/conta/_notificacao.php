<!-- views/layouts/_notificacao.php -->

<?php
use yii\helpers\Html;
use yii\helpers\Url;

foreach ($notificacoes as $notificacao) {
    // Personalize a exibição de cada notificação conforme necessário
    echo Html::tag('div', $notificacao->mensagem, ['class' => 'notificacao-item']);
}
?>
