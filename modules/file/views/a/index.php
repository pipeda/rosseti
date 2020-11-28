<?php
use yii\helpers\Url;
use app\widgets\Alert;
use app\widgets\Modalw;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Files');

$module = $this->context->module->id;

?>


<?= $this->render('_menu') ?>

<?= GridView::widget([
    'dataProvider' => $data,
    'summary' => "Показанно {begin} - {end} всего {totalCount}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'playtime',
        [
            'label' => 'Размер',
            'format' => 'raw',
            'value' => function($data){
    return  Yii::$app->formatter->asShortSize($data->size, 2) ;
            }
        ],
        [
            'label' => 'Создан',
            'format' => 'raw',
            'value' => function($data){
                return Yii::$app->formatter->asDatetime($data->time, 'short') ;
            }
        ],
        ['class' => 'yii\grid\ActionColumn',
            'header' => 'Управление',
            'template' => '{update}{delete}',
            'buttons'=>[

                'update' => function ($url,$data) {
                    $customurl=Yii::$app->getUrlManager()->createUrl(['/lk/file/a/edit','id'=>$data->primaryKey]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl, [
                        'title' => Yii::t('yii', 'редактировать'),
                    ]);
                }


            ]

        ],
    ],
]);


?>