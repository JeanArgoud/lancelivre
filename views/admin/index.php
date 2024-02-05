<?php
use yii\widgets\ListView;

$this->title = 'Área Admin';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
?>


<div>
    <?php
    echo ListView::widget([
        'dataProvider' => $requisicoesDataProvider,
        'itemView' => '_historicoRequisicoes',
        'layout' => "{items}\n{pager}",
    ]); 
    ?>
</div>