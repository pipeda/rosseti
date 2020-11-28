<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?= $this->render('_menuid',['id'=>$id]) ?>

<?php
$form = ActiveForm::begin(['action' => ['ideas/addfile?id='.$id],'options' => ['enctype' => 'multipart/form-data']]);
?>
<?= $form->field($file, 'name') ?>
<?= $form->field($file, 'file[]')->fileInput(['multiple' => true]) ?>

<button>Отправить</button>

<?php ActiveForm::end(); ?>
