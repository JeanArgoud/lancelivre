<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class ColaboradorController extends Controller
{
    // Página inicial das funções que colaboradores tem acesso a realizar
    public function actionIndex()
    {
        return $this->render('index');
    }
}