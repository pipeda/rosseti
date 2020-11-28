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
       'opis'
    ],
]) ?>

