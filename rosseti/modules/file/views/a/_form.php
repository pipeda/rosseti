<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\SeoForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'file')->fileInput() ?>
<?php if(!$model->isNewRecord) : ?>
    <div><a id="myFile" url_data="<?= Url::toRoute(['/lk/file/a/open/', 'id' => $model->file_id]) ?>" href="" ><?= basename($model->file) ?></a></div>
    <br>

   <?php Modal::begin([

    'header' => '<h2>Файл - '.basename($model->file).'</h2>',

    'headerOptions' => ['id' => 'modalHeader'],

    'id' => 'cityModal',

    'size' => 'modal-lg',

    'clientOptions' => ['backdrop' => 'static','tabindex'=>'-1']

    ]);

    echo "<div id='modalContent'></div>";

    yii\bootstrap\Modal::end();

    ?>
    <?php
    $js = <<< JS
     $('#myFile').on('click', function() { 
         $('#cityModal').modal('show');
       $('#modalContent').load($(this).attr('url_data')); 
         return false;
        });
$('#cityModal').on('hidden.bs.modal', function () {
      $("#modalContent").empty();
});

JS;

    $this->registerJs( $js, $position = yii\web\View::POS_READY, $key = null );
    ?>

<?php endif; ?>

<?php if(IS_ROOT) : ?>
    <?= $form->field($model, 'slug') ?>
    <?= SeoForm::widget(['model' => $model]) ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
<br>

    <div class="row">
        <div class="col-md-12">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
            </div>
        </div>

        </div>
