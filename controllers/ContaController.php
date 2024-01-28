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

    // Busca todos os serviços associados ao ID do usuário
    public function actionMeusServicos()
    {
        /*if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }*/
        
        $servicos = conta::getTodosServicos(Yii::$app->user->identity->id);
        return $this->render('meus-servicos', [
            'servicos' => $servicos,
        ]);
    }

    // para virar colaborador: Yii::$app->urlManager->createUrl(['site/solicitar-colaborador'])
}
