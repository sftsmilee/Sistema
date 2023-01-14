<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\Avance $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="avance-form">

    <?php $form = ActiveForm::begin(['options'=>['autocomplete'=>'off']]); ?>

    <div style="display: none">
        <?= $form->field($model, 'id_tesis')->textInput() ?>
    </div>

    <?= $form->field($model, 'archivo')->widget(FileInput::className(),[
            'options' => ['multiple' => false],
            'pluginOptions'=>['allowedFileExtensions'=>['pdf']]
        ])
    ?>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
