<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$this->title = 'Minha Conta';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/style.css');
?>

<div class="row">
    <div class="col-md-3">
        <?php           
            NavBar::begin([
                'options' => [
                    'class' => 'navbar-expand-md navbar-light bg-light',
                ],
            ]);

            $abas = [                
                ['label' => 'Meus Serviços', 'url' => ['/conta/meus-servicos']],
                ['label' => 'Meus Cartões', 'url' => ['/conta/meus-cartoes']],  
                ['label' => 'Notificações', 'url' => ['/conta/notificacoes']],                              
                ['label' => 'Sair', 'url' => ['conta/logout'], 'linkOptions' => ['data-method' => 'post']]
            ];
            if(!Yii::$app->user->identity->requisicaoColaboradorAprovada()){
                array_push($abas, ['label' => 'Tornar-se Colaborador', 'url' => ['/conta/solicitar-colaborador']] );                
            }            

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav flex-column'],
                'items' => $abas
            ]);

            NavBar::end();
        ?>
    </div>
    <div class="col-md-9">
        <!-- Conteúdo da página da conta do usuário -->
        <h1><?= Html::encode($this->title) ?></h1>
        <!-- Restante do conteúdo aqui -->
    </div>
</div>

