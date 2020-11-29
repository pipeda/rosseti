<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Россети';

?>
<?= $this->render('_menu') ?>

<?= GridView::widget([
    'dataProvider' => $data,
    'summary' => false,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
       'opis',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{link}',
            'buttons' => [
                'link' => function ($url,$model,$key) {
                    return Html::a('Утвердить', Url::to(['#', 'id' => $key]));},

            ],
        ],
    ],
]) ?>

