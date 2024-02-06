<?php
use yii\widgets\ListView;

$this->title = 'Área Admin';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
$this->registerCssFile('@web/css/tabelas.css');
?>

<h2>Requisições</h2>
<div>
    <?php
    echo ListView::widget([
        'dataProvider' => $requisicoesDataProvider,
        'itemView' => '_historicoRequisicoes',
        'layout' => "{items}\n{pager}",
    ]); 
    ?>
</div>