<?php
use yii\helpers\Html;

$this->title = 'Aviso';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Somente colaboradores podem criar serviços.</p>
<p>Se deseja se tornar um colaborador, <a href="<?= Yii::$app->urlManager->createUrl(['site/solicitar-colaborador']) ?>">clique aqui</a> para enviar uma solicitação.</p>
