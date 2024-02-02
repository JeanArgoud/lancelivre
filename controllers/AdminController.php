<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RequisicaoColaborador;
use yii\data\ActiveDataProvider;

class AdminController extends Controller
{
    // página inicial das funções que o admin tem acesso, incluindo histórico de requisições para se tornarem colaboradores
    public function actionIndex()
    {
        $query = RequisicaoColaborador::find();
        // Recupere as mensagens associadas a este canal
        $requisicoesDataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['data_envio' => SORT_ASC],
            ]
        ]);
        return $this->render('index', [ 'requisicoesDataProvider' => $requisicoesDataProvider ]);
    }

    // Visualiza os detalhes de uma requisição e permite respondê-la
    public function actionDetalhesRequisicao($id_requisicao)
    {
        $requisicao = RequisicaoColaborador::find()->where(['id'=>$id_requisicao])->one();
        if(!$requisicao){
            Yii::$app->getSession()->setFlash('error', 'Erro tentando encontrar a requisição.');
            return $this->redirect(['admin/index']);
        }

        if ($requisicao->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('RequisicaoColaborador');  
            $requisicao->setAttributes($post, false);
            if($requisicao->aprovado !== null){   
                if($requisicao->save()){
                    Yii::$app->getSession()->setFlash('success','Requisição respondida!');
                }
                else{
                    Yii::$app->getSession()->setFlash('success','Erro ao tentar responder a requisição.');
                }
                return $this->redirect(['admin/index']);
            }
            else{
                Yii::$app->getSession()->setFlash('success','É obrigatório preencher se ele foi aprovado ou não.');
            }
        }
        return $this->render('detalhesRequisicao', [ 'requisicao' => $requisicao ]);
    }
}