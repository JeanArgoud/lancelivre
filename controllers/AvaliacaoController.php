<?php
// controllers/AvaliacaoController.php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Avaliacao;
use yii\data\ActiveDataProvider;


// ...
class AvaliacaoController extends Controller
{
    public function actionCreate($id_servico, $id_usuario)
    {
        $model = new Avaliacao();
        $model->id_servico = $id_servico;
        $model->id_usuario = $id_usuario;
        $model->data = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Avaliação salva com sucesso.');
            return $this->redirect(['servico/view', 'id' => $id_servico]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEdit($avaliacaoId)
    {
        $model = $this->findModel($avaliacaoId);

        if ($model->load(Yii::$app->request->post())) {
            // Calcula data atual
            $model->data = date('Y-m-d H:i:s');

            if($model->save()){
                Yii::$app->session->setFlash('success', 'Avaliação atualizada com sucesso.');
                return $this->redirect(['servico/view', 'id' => $model->id_servico]);
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Avaliacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página solicitada não existe.');
    }
}