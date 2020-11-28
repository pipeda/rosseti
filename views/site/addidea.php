<?php
/**
 * Created by PhpStorm.
 * User: pipeda
 * Date: 28.11.2020
 * Time: 7:06
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'Idea-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'opis')->textarea() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>