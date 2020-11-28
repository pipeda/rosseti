<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Россети';

?>
<h2>Мои идеи</h2>
    <br>
<?= GridView::widget([
    'dataProvider' => $data,
    'summary' => false,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'opis',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{link}<br>{status}',
            'buttons' => [
                'link' => function ($url,$model,$key) {
                    return Html::a('Открыть', Url::to(['/ideas/view', 'id' => $key]));
                },
                'status' => function ($url,$model,$key) {
                    return Html::a('Статус', Url::to(['/ideas/index', 'id' => $key]));
                },
            ],
        ],
    ],
]) ?>