<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Idea;
use yii\data\ActiveDataProvider;
use app\models\File;
use app\models\UploadForm;
use yii\web\UploadedFile;

class LkController extends Controller
{
    public $pending = 0;
    public $processed = 0;
    public $sent = 0;
    /**
     * {@inheritdoc}
     */

    public function beforeAction($action)
    {
        $this->layout = '@app/views/layouts/mainlk'; //your layout name
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
                'pageSize' => 5,
            ]
        ]);
        return $this->render('index',[
            'data' => $data
        ]);

    }
    public function actionAddidea()
    {

        $model = new Idea();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {

                return $this->redirect('/ideas/index');
            }else{


                return $this->redirect('/ideas/index')
                ;}
        } else {
            return $this->redirect('/ideas/index');
        }

    }
    public function actionAddfile($id)
    {
        $file = new UploadForm();
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post('UploadForm');
            $mfile =UploadedFile::getInstances($file, 'file');
                foreach ($mfile as $file) {
                    $file->saveAs('upload/' . $file->baseName . '.' . $file->extension);
                    $model = new File();
                    $model->name=$post['name'];
                    $model->id_idea=$id;
                    $model->put='upload/' . $file->baseName . '.' . $file->extension;
                    $model->save();
                }


         /*   if ($model->save()) {

            }*/
            return $this->redirect('/ideas/spis?id='.$id);
        } else {
            return $this->redirect('/ideas/spis?id='.$id);
        }

    }

    public function actionView($id)
    {
        $model = Idea::find()->where(['id' => $id ])->one();;
        $file= new UploadForm();
            return $this->render('view', [
                'model' => $model,'file'=>$file,'id'=>$id
            ]);

    }
    public function actionSpis($id)
    {
        $query = File::find()->where(['id_idea' => $id ]);
        $data = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        return $this->render('spis',[
            'data' => $data,'id'=>$id
        ]);

    }
    public function actionPending($id)
    {
        $query = File::find()->where(['id_idea' => $id ]);
        $data = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        return $this->render('spis',[
            'data' => $data,'id'=>$id
        ]);

    }
}
