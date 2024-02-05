<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Servico;
use app\models\ServicoForm;
use app\models\ServicoSearch;
use app\models\Canal;
use app\models\Conta;
use app\models\CartaoCredito;
use app\models\ContratarForm;
use app\models\Mensagem;
use app\models\Avaliacao;
use app\models\Pergunta;
use app\models\PerguntaForm;
use app\models\Notificacao;
use yii\data\ActiveDataProvider;

class ServicoController extends Controller
{
    public function actionIndex($categoria = null)
    {
        $searchModel = new ServicoSearch(); // Certifique-se de criar o modelo de pesquisa
        
        if ($categoria) $searchModel->categoria = $categoria;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = servico::findModel($id);
        $perguntaForm = new PerguntaForm();
        $avaliacoes = Avaliacao::find()->where(['id_servico' => $model->id])->all();
        $contratarForm = new ContratarForm();
        return $this->render('view', [
            'model' => $model,
            'avaliacoes' => $avaliacoes,
            'perguntaForm' => $perguntaForm,
            'contratarForm' => $contratarForm,
        ]);
    }


    public function actionContatar($id)
    {
        // Verifique se o usuário está autenticado
        if (Yii::$app->user->isGuest) {
            // Redirecione para a página de login se o usuário não estiver autenticado
            return $this->redirect(['conta/login']);
        }
        // Obtenha o serviço
        $servico = servico::findModel($id);

        // Obtenha o colaborador associado ao serviço
        $colaborador = $servico->colaborador;

        // Obtenha o canal existente ou crie um novo
        $canal = Canal::findOrCreate(Yii::$app->user->identity->id, $colaborador->id);

        // Recupere as mensagens associadas a este canal
        $dataProvider = new ActiveDataProvider([
            'query' => Mensagem::find()->where(['id_canal' => $canal->id]),
            'sort' => [
                'defaultOrder' => ['data_envio' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => 10, // Defina a quantidade desejada de mensagens por página
            ],
        ]);

        // Crie um novo modelo de mensagem para o formulário
        $mensagemModel = new Mensagem();

        // Processar o envio do formulário
        if ($mensagemModel->load(Yii::$app->request->post())) {
            // Preencher o modelo com os dados do formulário
            $mensagemModel->id_canal = $canal->id;
            $mensagemModel->data_envio = date('Y-m-d H:i:s'); // Data atual
            $mensagemModel->enviado_por = Yii::$app->user->identity->nome;
            // Salvar a mensagem na base de dados
            if ($mensagemModel->save()) {
                // Redirecione para evitar o reenvio do formulário ao recarregar a página
                return $this->redirect(['contatar', 'id' => $id]);
            } else {
                Yii::error('Erro ao salvar a mensagem: ' . print_r($mensagemModel->errors, true));
            }
        }

        return $this->render('contatar', [
            'model' => $servico,
            'canal' => $canal,
            'mensagemModel' => $mensagemModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionContratar($id)
    {
        // Verifica se o usuário está logado
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Você precisa estar logado para contratar um serviço.');
            return $this->redirect(['site/login']);
        }

        // Form semi preenchido
        $model = new ContratarForm();
        $model->id_servico = $id;
        $model->id_usuario = Yii::$app->user->id;
        
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            // Obtém o cartão selecionado
            $servico = Servico::findOne($model->id_servico);
            $cartao_usuario = CartaoCredito::findOne($model->id_cartao);
            $cartao_colab = CartaoCredito::findOne($servico->colaborador_id);

            /*// Verifica se o cartão possui crédito suficiente
            if ($cartao->credito < $servico->preco) {
                Yii::$app->session->setFlash('error', 'Crédito insuficiente. Selecione outro cartão ou adicione crédito ao seu cartão.');
                return $this->redirect(['view', 'id' => $servico->id]);
            }
        
            // Atualiza o crédito do cartão
            $cartao->credito -= $servico->preco;
            $cartao->save();
            */
            $cartaoUsuarioId = $cartao_usuario->id;
            $cartaoColaboradorId = $cartao_colab->id;
            $valorDoServico = $servico->preco;
            // Tentar depositar o valor na conta do colaborador
            if (!CartaoCredito::depositarValor($cartaoUsuarioId, $cartaoColaboradorId, $valorDoServico)) {
                Yii::$app->session->setFlash('error', 'Crédito insuficiente no cartão.');
                return $this->redirect(['visualizar', 'id' => $id]);
            }
            // Após a transação bem-sucedida, notifica o colaborador e o usuário comprador
            $usuarioComprador = Yii::$app->user->identity;
            
            // Notifica o usuario
            $mensagemNotificacao = 'Você contratou os serviços de ' . $servico->colaborador->nome . ' no valor de ' . $valorDoServico; 
            Notificacao::enviarNotificacao($model->id_usuario, $mensagemNotificacao);
            
            // Notificar colaborador
            $mensagemNotificacao = $usuarioComprador->nome . ' contratou seus serviços!' . ' depositado valor de' . $valorDoServico;
            Notificacao::enviarNotificacao($servico->colaborador_id, $mensagemNotificacao);

            Yii::$app->session->setFlash('success', 'Serviço contratado com sucesso.');
            return $this->redirect(['view', 'id' => $servico->id]);
        }
        // Obtém os cartões do usuário atual
        $cartoes = CartaoCredito::getTodosCartoes(Yii::$app->user->id);
        $cartoesList = \yii\helpers\ArrayHelper::map($cartoes, 'id', 'bandeira'); // Ajuste conforme os atributos do seu modelo Cartao

        return $this->render('contratar', [
            'model' => $model,
            'cartoes' => $cartoesList,
        ]);

    }

    public function actionAvaliar($id)
    {
        // Verifique se o usuário está autenticado
        if (Yii::$app->user->isGuest) {
            // Redirecione para a página de login se o usuário não estiver autenticado
            return $this->redirect(['conta/login']);
        }
    
        $servico = servico::findModel($id);
        $usuarioId = Yii::$app->user->identity->id;
    
        // Verifique se o usuário já avaliou este serviço
        $avaliacaoExistente = Avaliacao::find()
            ->where(['id_servico' => $servico->id, 'id_usuario' => $usuarioId])
            ->one();
    
        if ($avaliacaoExistente) {
            // Redirecione para a página de edição da avaliação existente
            return $this->redirect(['avaliacao/edit', 'avaliacaoId' => $avaliacaoExistente->id]);
        }
    
        // Redirecione para a página de avaliação com os parâmetros necessários
        return $this->redirect(['avaliacao/create', 'id_servico' => $servico->id, 'id_usuario' => $usuarioId]);
    }

    public function actionRespostaPergunta($id)
    {
        $model = servico::findModel($id);
    
        if (Yii::$app->request->isPost) {
            $perguntaId = Yii::$app->request->post('perguntaId');
            $respostaTexto = Yii::$app->request->post('Pergunta')['resposta'];
    
            $pergunta = Pergunta::findOne($perguntaId);
    
            if ($pergunta) {
                if (!$pergunta->resposta) {
                    $pergunta->resposta = $respostaTexto;
    
                    if ($pergunta->save()) {
                        Yii::$app->session->setFlash('success', 'Resposta enviada com sucesso.');
                    } else {
                        Yii::$app->session->setFlash('error', 'Erro ao salvar a resposta.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Já existe uma resposta para esta pergunta.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Pergunta não encontrada.');
            }
        }
    
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionEnviarPergunta($id)
    {
        $model = servico::findModel($id);
        $perguntaForm = new PerguntaForm();

        if ($perguntaForm->load(Yii::$app->request->post()) && $perguntaForm->validate()) {
            // Verificar se os campos não são nulos
            $pergunta = new Pergunta();
            $pergunta->titulo = $perguntaForm->titulo;
            $pergunta->pergunta = $perguntaForm->corpo;
            $pergunta->id_servico = $model->id;
            $pergunta->id_usuario = Yii::$app->user->identity->id;
            $pergunta->data = date('Y-m-d H:i:s'); // Adiciona a data atual

            if ($pergunta->save()) {
                Yii::$app->session->setFlash('success', 'Pergunta enviada com sucesso.');
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao enviar a pergunta.');
            }
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionCreate()
    {
        $model = new ServicoForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Criar novo serviço com os dados do formulário 
            $servico = new Servico();
        
            $servico->colaborador_id = Yii::$app->user->identity->id;
            $servico->nome = $model->nome;
            $servico->preco = $model->preco;
            $servico->categoria = $model->categoria;
            $servico->descricao = $model->descricao;
            $servico->endereco = $model->endereco;
            $servico->avaliacao = 0;

            if ($servico->save())
            {
                Yii::$app->session->setFlash('success', 'Serviço criado com sucesso.');
                return $this->redirect(['conta/meus-servicos']);
            }
            else{
                Yii::$app->session->setFlash('error', 'Erro ao criar o serviço.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEdit($serviceId)
    {
        $servico = Servico::findOne($serviceId);
        if (!$servico) {
            throw new \yii\web\NotFoundHttpException('Serviço não encontrado.');
        }

        $model = new ServicoForm();
 
        // Preenche o modelo do formulário com os valores do serviço existente
        $model->nome = $servico->nome;
        $model->preco = $servico->preco;
        $model->endereco = $servico->endereco;
        $model->categoria = $servico->categoria;
        if ($model->load(Yii::$app->request->post())) {
            // Atualizar os atributos do serviço com os dados do formulário
            $servico->nome = $model->nome;
            $servico->preco = $model->preco;
            $servico->endereco = $model->endereco;
            $servico->categoria = $model->categoria;

            if ($servico->save()) {
                Yii::$app->session->setFlash('success', 'Serviço atualizado com sucesso.');
                return $this->redirect(['conta/meus-servicos']);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao atualizar o serviço.');
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }
    

    public function actionDelete($serviceId)
    {
        $servico = Servico::findOne($serviceId);

        if (!$servico) {
            throw new \yii\web\NotFoundHttpException('Serviço não encontrado.');
        }

        if ($servico->delete()) {
            Yii::$app->session->setFlash('success', 'Serviço deletado com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao deletar o serviço.');
        }

        return $this->redirect(['conta/meus-servicos']);
    }

    public function actionShowService($serviceId)
    {

    }

    //pesquisa servico por colaborador
    public function actionConsultaPorColaborador($colaboradorId)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Servico::findByColaboradorId($colaboradorId),
        ]);

        return $this->render('consulta-por-colaborador', [
            'dataProvider' => $dataProvider,
            'colaboradorId' => $colaboradorId,
        ]);
    }

    //pesquisa por nome

    //pesquisa por preço
}
