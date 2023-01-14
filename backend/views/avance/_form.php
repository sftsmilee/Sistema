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

    <?= $form->field($model, 'fechahora')->widget(DateControl::className(), [ //Para fecha y hora
        'type'=>DateControl::FORMAT_DATETIME,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ])?>


    <div class="form-group">
        <br>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
