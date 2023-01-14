<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Avance $model */

//$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Fecha de Presentación de Avance';
\yii\web\YiiAsset::register($this);

//Desactiva el botón de subir archivo si aún no hay archivo subido
$js= "
    $(document).ready(function(){
        var arch = $('#arc').val();
        if(!arch == ''){
            $('#boton3').attr('class','btn btn-primary');
        } else{
            $('#boton3').attr('class','btn btn-primary disabled');
        }
    });
";
$this->registerJs($js);
?>

<div class="avance-view">

    <h1><?= Html::encode('Fecha de Presentación de Avance') ?></h1>

    <p>
        <?= Html::a('Evaluación', ['calificaciones/index', 'id'=>$model->id, 'idT'=>99], ['class' => 'btn btn-success', 'id'=>'boton2']) ?>
        <?= //Para visualizar archivos subidos
        Html::a("Ver Archivo", \yii\helpers\Url::base(true)."/uploads/archivos/".$model->archivo, ['class'=>'btn btn-primary disabled', 'id'=>'boton3']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ntesis',
            'fecha',
            'hora',
            'estado'
        ],
    ]) ?>

    <div style="display: none">
        <?= Html::textInput('archivo', $model->archivo, ['id'=>'arc'])?>
    </div>

</div>
