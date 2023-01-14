<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */
/** @var yii\widgets\ActiveForm $form */

/*
Codigo para desactivar el boton si hay campos vacios:
    Esto lo hace si el estado de la tesis se encuentra como 'Pendiente', y se mantendrá
    así si no se le asigna un comité tutorial, una vez todos los miembros sean seleccionados
    se activará el botón y el estado pasará a 'Aprobado'.
*/
$js= "
    $(document).ready(function(){
        var est = $('#tesis-estado').val();
        if(est == 'Pendiente'){
            $('#boton').attr('disabled',true);
        }
        $('.tesis-form').change(function(){
            var f1 = $('#tesis-director').val();
            var f2 = $('#tesis-codirector').val();
            var f3 = $('#tesis-secretario').val();
            var f4 = $('#tesis-vocal').val();
            
            if(f1 == '' || f2 == '' || f3 == '' || f4 == ''){
                $('#tesis-estado').val('');
                $('#boton').attr('disabled',true); 
            } else {
                $('#tesis-estado').val('Aprobado');
                $('#boton').attr('disabled',false);
            } 
        });
    });
";
$this->registerJs($js);
?>

<div class="tesis-form">

    <?php $form = ActiveForm::begin(); ?>
    <!-- Muestra los docentes que existen en forma de lista -->
    <?= $form->field($model, 'director')->dropDownList(\common\models\Docentes::ListaDocentes(),['prompt'=>'Seleccione un docente...']) ?>

    <?= $form->field($model, 'codirector')->dropDownList(\common\models\Docentes::ListaDocentes(),['prompt'=>'Seleccione un docente...']) ?>

    <?= $form->field($model, 'secretario')->dropDownList(\common\models\Docentes::ListaDocentes(),['prompt'=>'Seleccione un docente...']) ?>

    <?= $form->field($model, 'vocal')->dropDownList(\common\models\Docentes::ListaDocentes(),['prompt'=>'Seleccione un docente...']) ?>

    <div style="display: none">
        <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="form-group">
        <br>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id'=>'boton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
