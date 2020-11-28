<?php
namespace app\modules\file\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\components\Controller;
//use yii\web\Controller;
use app\modules\file\models\File;
use app\helpers\Upload;
use app\behaviors\SortableController;
use kato\getid3\Yii2GetID3;
use app\components\FFmpeg;

class AController extends Controller
{
    public function behaviors()
    {
        return [

            [
                'class' => SortableController::className(),
                'model' => File::className()
            ],
            'access' => [
                'class' => AccessControl::className(),
                'user'=>'user',
                'only' => ['create','index','edit','delet','up','down'],
                'rules' => [
                    [
                        'actions' => ['create','index','edit','delet','up','down'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        $data = new ActiveDataProvider([
            'query' => File::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->sort(),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);
        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate($slug = null)
    {
        $model = new File;

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(($fileInstanse = UploadedFile::getInstance($model, 'file')))
                {
                    $model->file = $fileInstanse;
                    if($model->validate(['file'])){
                        $getID3 = new Yii2GetID3();
                        $model->file = Upload::file($fileInstanse, 'files', false);
                        $model->size = $fileInstanse->size;
                        $model->user_id=Yii::$app->user->id;
                        $fileout=$getID3->getData(substr($model->file, 1));
                        $model->mime_type=$fileout['mime_type'];
                        if($fileout['fileformat']=="jpg" || $fileout['fileformat']=="png" ){$model->playtime=6;}else{$model->playtime=floor($fileout['playtime_seconds']);}
                        $filept = date("i:s", mktime(0, 0, $model->playtime));

                        if($model->save()){
                            $this->flash('success', Yii::t('app', [
                                'type' => 'success',
                                'duration' => 7000,
                                'icon' => 'glyphicon glyphicon-user',
                                'message' => 'Ролик создан продолжительность - '.$filept,
                                'title' => 'Ролик',
                                'positonY' => 'top',
                                'positonX' => 'left'
                            ]));
                            return $this->redirect(['/lk/file/']);
                        }
                        else{
                            $this->flash('error', Yii::t('app', 'Create error. {0}', $model->formatErrors()));
                        }
                    }
                    else {
                        $this->flash('error', Yii::t('app', 'File error. {0}', $model->formatErrors()));
                    }
                }
                else {
                    $this->flash('error', Yii::t('yii', '{attribute} cannot be blank.', ['attribute' => $model->getAttributeLabel('file')]));
                }
                return $this->refresh();
            }
        }
        else {
            if($slug) $model->slug = $slug;

            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = File::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('app', 'Not found'));
            return $this->redirect(['/lk/file/']);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(($fileInstanse = UploadedFile::getInstance($model, 'file')))
                {
                    $model->file = $fileInstanse;
                    if($model->validate(['file'])){
                        $getID3 = new Yii2GetID3();
                        $model->file = Upload::file($fileInstanse, 'files', false);
                        $model->size = $fileInstanse->size;
                        $model->time = time();
                        $fileout=$getID3->getData(substr($model->file, 1));
                        $model->mime_type=$fileout['mime_type'];
                        if($fileout['fileformat']=="jpg" || $fileout['fileformat']=="png" ){$model->playtime=6;}else{$model->playtime=floor($fileout['playtime_seconds']);}

                        $filept = date("i:s", mktime(0, 0, $model->playtime));

                    }
                    else {
                        $this->flash('error', Yii::t('app', 'File error. {0}', $model->formatErrors()));
                        return $this->refresh();
                    }
                }
                else{
                    $model->file = $model->oldAttributes['file'];
                }

                if($model->save()){
                    $this->flash('success', Yii::t('app', [
                        'type' => 'success',
                        'duration' => 7000,
                        'icon' => 'glyphicon glyphicon-user',
                        'message' => 'Ролик обновлен продолжительность - '.$filept,
                        'title' => 'Ролик',
                        'positonY' => 'top',
                        'positonX' => 'left'
                    ]));
                }
                else {
                    $this->flash('error', Yii::t('app', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }
    public function actionOpen($id){
        $this->layout ='@app/views/layouts2/net';

        $model = File::findOne($id);
        return $this->render('open', [
            'model' => $model
        ]);


        }
    public function actionDelete($id)
    {
        if(($model = File::findOne($id))){
            $model->delete();
        } else {
            $this->error = Yii::t('app', 'Not found');
        }
        return $this->formatResponse(Yii::t('app', 'File deleted'));
    }

    public function actionUp($id)
    {
        return $this->move($id, 'up');
    }

    public function actionDown($id)
    {
        return $this->move($id, 'down');
    }
}