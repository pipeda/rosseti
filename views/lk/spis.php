<?php
/**
 * Created by PhpStorm.
 * User: pipeda
 * Date: 28.11.2020
 * Time: 23:02
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Россети';
?>
<?= $this->render('_menuid',['id'=>$id]) ?>
<h2>Файлы к рационализаторскому предложению ID <?= $id ?></h2>
<br>
<?= GridView::widget([
    'dataProvider' => $data,
    'summary' => false,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'id_idea' ,
        'created_at',
        'put',
    ],
]) ?>
