<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\conta;

class SiteController extends Controller
{

    // Página inicial
    public function actionIndex()
    {
        return $this->render('index');
    }

    // Página para fazer login com um usuário. Redireciona para a página inicial se tentar entrar nesta página já estando logado.
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $conta = new conta();
        if ($conta->load(Yii::$app->request->post()) && $conta->login()) {
            return $this->goBack();
        }

        $conta->senha = '';
        return $this->render('login', [
            'conta' => $conta,
        ]);
    }

    // Faz logout com seu usuário e volta para a página inicial
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
