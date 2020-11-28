<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;
use app\models\Idea;
use yii\data\ActiveDataProvider;


class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */

    public function beforeAction($action)
    {
        $this->layout = '@app/views/layouts/main'; //your layout name
        return parent::beforeAction($action);
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Idea::find();

        $data = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index',[
        'data' => $data,
            ]);
    }
    public function actionAddidea()
    {
        $model=new Idea();
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {

            }
        }else{
            return $this->render('addidea', [
                'model' => $model,
            ]);
        }



    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/lk/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionPlay()
    {
        return $this->render('play');

    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
