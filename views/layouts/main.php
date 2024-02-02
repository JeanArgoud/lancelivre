<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'Lancelivre',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    
    $abas = [];
    if (Yii::$app->user->isGuest) {            
        array_push($abas, ['label' => 'Login', 'url' => ['conta/login']]);
        array_push($abas, ['label' => 'Criar Conta', 'url' => ['conta/criar-conta']]);
    }
    else{
        // Dados da conta só é acessável por usuário logado
        $botaoLogout = '<li>'
        . Html::beginForm(['conta/logout'], 'post', ['class' => 'form-inline'])
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->nome . ')',
            ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
     
        array_push($abas, ['label' => 'Conta', 'url' => ['conta/index']]);
        array_push($abas, $botaoLogout);
        if(Yii::$app->user->identity->contaDeAdmin()){
            array_push($abas, ['label' => 'Área Admin', 'url' => ['admin/index']]);
        }
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $abas,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Lancelivre <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
