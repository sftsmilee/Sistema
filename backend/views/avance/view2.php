<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Avance $model */
/** @var yii\widgets\ActiveForm $form */

//$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Presentación de Avance";
\yii\web\YiiAsset::register($this);

//Desactiva los botones de subir y modificar archivo si aún no hay archivo subido
$js= "
    $(document).ready(function(){
        var arch = $('#arc').val();
        if(!arch == ''){
            $('#boton').hide();
            $('#boton2').attr('class','btn btn-success');
            $('#boton3').attr('class','btn btn-primary');
        } else{
            $('#boton2').hide();
            $('#boton3').hide();
        }
    });
";
$this->registerJs($js);
?>

<div class="avance-view">

    <h1><?= Html::encode("Presentación de Avance") ?></h1>

    <p>
        <?= Html::a('Subir Archivo', ['update2', 'id' => $model->id], ['class' => 'btn btn-success', 'id'=>'boton']) ?>
        <?= Html::a('Modificar Archivo', ['update2', 'id' => $model->id], ['class' => 'btn btn-primary disabled', 'id'=>'boton2']) ?>
        <?= //Para visualizar archivos subidos
        Html::a("Ver Archivo", \yii\helpers\Url::base(true)."/uploads/archivos/".$model->archivo, ['class'=>'btn btn-primary disabled', 'id'=>'boton3']) ?>
        <!--
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ntesis',
            'fecha',
            'hora',
            'estado',
            'calificacion',
            [
                'label'=>'Detalles de Evaluación', //Muestra las calificaciones de todos los miembros del comité
                'value'=> function($model){
                    $cal = \common\models\Calificaciones::findOne(['id_avance'=>$model->id]);
                    if($cal){ //Si al menos un miembro ha evaluado
                        return Html::a("Ver Detalles", ['calificaciones/index', 'id'=> $model->id, 'idT'=>0]);
                    }else{ //Si nadie ha evaluado
                        return Html::label('Aún no han calificado');
                    }
                },
                'format'=>'raw',
            ],
        ],
    ]) ?>

    <div style="display: none">
        <?= Html::textInput('archivo', $model->archivo, ['id'=>'arc'])?>
    </div>
</div>

