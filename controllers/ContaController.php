<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Conta;
use app\models\Servico;
use app\models\Colaborador;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
class ContaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Apenas usuários autenticados
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        /*if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }*/
        return $this->render('index');
    }

    public function actionMyServices()
    {
        /*if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }*/

        $colaboradorId = Yii::$app->user->identity->id;
        
        if (Yii::$app->user->identity->tipo == 3) {
            // Busca todos os serviços associados ao ID do colaborador
            $servicos = Servico::find()
                ->where(['colaborador_id' => $colaboradorId])
                ->all();

            return $this->render('my-services', [
                'servicos' => $servicos,
            ]);
        } else {
            return $this->render('not-colab');
        }
    }
}
