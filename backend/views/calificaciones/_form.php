<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Calificaciones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="calificaciones-form">

    <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => "{label}\n{input}\n{hint}"]]) ?>

    <div style="display:none">
        <?= $form->field($model, 'id_avance')->textInput() ?>

        <?= $form->field($model, 'id_docente')->textInput() ?>

        <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'p1')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <?= $form->field($model, 'p2')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <?= $form->field($model, 'p3')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <?= $form->field($model, 'p4')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <?= $form->field($model, 'p5')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <?= $form->field($model, 'p6')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <?= $form->field($model, 'p7')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <?= $form->field($model, 'p8')->textInput(['type'=>'number', 'min'=>0, 'max'=>100]) ?>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id'=>'boton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
