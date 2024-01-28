<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
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
        if ($conta->load(Yii::$app->request->post())) {
            if($conta->login()){
                Yii::$app->getSession()->setFlash('success','Credenciais corretas. Bem vindo ao Lance Livre!');
                return $this->goBack();
            }
            else{
                Yii::$app->getSession()->setFlash('error', 'Credenciais incorretas.');
            }
        }

        $conta->senha = '';
        return $this->render('login', ['conta' => $conta]);
    }

    // Faz logout com seu usuário e volta para a página inicial
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // Criar uma nova conta de usuário ou colaborador
    public function actionCriarConta()
    {
        $novaConta = new conta;

        if ($novaConta->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('conta');   
            $novaConta->setAttributes($post, false);            
            if($novaConta->validate()){
                if($novaConta->emailUnico()){
                    if($novaConta->save()){
                        Yii::$app->getSession()->setFlash('success','Usuário criado com sucesso!');
                        return $this->goBack();
                    }
                }
                else{
                    Yii::$app->getSession()->setFlash('error','Já existe um usuário com este email.');
                }
            }
        }

        return $this->render('criarConta',['novaConta'=>$novaConta]);
    }

    public function actionSolicitarColaborador()
    {
        $user = Yii::$app->user->identity;

        $user->tipo = 3;

        if ($user->save())
        {
            Yii::$app->session->setFlash('success', 'Solicitação enviada com sucesso. Aguarde a aprovação.');            
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao processar a solicitação.');
        }

        return $this->goHome(); // Redireciona para a página inicial ou outra página apropriada
    }
}
