<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Conta;
use app\models\Servico;
use app\models\Colaborador;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
class ContaController extends Controller
{
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::class,
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'roles' => ['@'], // Apenas usuários autenticados
    //                 ],
    //             ],
    //         ],
    //     ];
    // }
    public function actionIndex()
    {
        return $this->render('index');
    }

    // Busca todos os serviços associados ao ID do usuário
    public function actionMeusServicos()
    {   
        $servicos = conta::getTodosServicos(Yii::$app->user->identity->id);
        return $this->render('meus-servicos', [
            'servicos' => $servicos,
        ]);
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



    // para virar colaborador: Yii::$app->urlManager->createUrl(['conta/solicitar-colaborador'])
}
