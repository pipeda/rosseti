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

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Отправить файл', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
