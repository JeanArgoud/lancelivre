<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$this->title = 'Minha Conta';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <?php
            NavBar::begin([
                'options' => [
                    'class' => 'navbar-expand-md navbar-light bg-light',
                ],
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav flex-column'],
                'items' => [
                    ['label' => 'Informações da conta', 'url' => ['/conta/info']],
                    ['label' => 'Meus Serviços', 'url' => ['/conta/meus-servicos']],
                    ['label' => 'Sair', 'url' => ['conta/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
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

