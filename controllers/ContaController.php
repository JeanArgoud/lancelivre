<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Conta;
use app\models\Servico;
use app\models\RequisicaoColaborador;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
class ContaController extends Controller
{    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionErro()
    {
        $mensagem = 'Um erro inesperado aconteceu.';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $mensagem = $exception->getMessage();
        }
        return $this->render('erro',['mensagem'=>$mensagem]);
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
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $conta = conta::find()->where(['id'=>Yii::$app->user->identity->id])->one();    

        if ($conta->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('conta');   
            $conta->setAttributes($post, false); 
            if($conta->validate()){                
                if($conta->save()){
                    $requisicao = new requisicaoColaborador;
                    if($requisicao->save()){
                        Yii::$app->getSession()->setFlash('success','A requisição para você se tornar um colaborador foi enviada com sucesso!');
                    }
                    else{
                        Yii::$app->getSession()->setFlash('error','Ocorreu um erro ao tentar enviar sua requisição para se tornar um colaborador.');
                    }
                    return $this->goBack();
                }                                
            }
        }

        return $this->render('solicitarColaborador',['conta'=>$conta]);
    }

    

    // para virar colaborador: Yii::$app->urlManager->createUrl(['conta/solicitar-colaborador'])
}
