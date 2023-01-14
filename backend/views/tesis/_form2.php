<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */
/** @var yii\widgets\ActiveForm $form */

/*
Codigo para desactivar el boton si hay campos vacios:
    Esto lo hace si el estado de la tesis se encuentra en blanco, y se mantendrá
    así si no se ingresa el titulo y objetivos, una vez se ingresén,
    se activará el botón y el estado pasará a 'Pendiente'.
*/
$js= "
    $(document).ready(function(){
        var est = $('#tesis-estado').val();
        if(est == ''){
            $('#boton').attr('disabled',true);
        }
        $('.tesis-form').change(function(){
            var f1 = $('#tesis-titulo').val();
            var f2 = $('#tesis-objetivo').val();
            
            if(f1 == '' || f2 == ''){
                $('#tesis-estado').val('');
                $('#boton').attr('disabled',true);
            } else {
                $('#tesis-estado').val('Pendiente');
                $('#boton').attr('disabled',false);
            } 
        });
    });
";
$this->registerJs($js);
?>

<div class="tesis-form">

    <?php $form = ActiveForm::begin(); ?>

    <div style="display: none">
        <?= $form->field($model, 'estudiante_id')->textInput() ?>
    </div>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objetivo')->textArea(['maxlength' => true, 'style'=>'height:75px']) ?>

    <div style="display: none">
        <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id'=>'boton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
