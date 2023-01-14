<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Avance;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */

$this->title = 'Tesis';
//$this->params['breadcrumbs'][] = ['label' => 'Lista de Tesis', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$archivo = Avance::findOne(['id_tesis'=>$model->id]); //Busca un avance
if($archivo){
    $etiqueta=Html::textInput('archivo', $archivo->archivo, ['id'=>'arc']); //Será igual al nombre del archivo
}else{
    $etiqueta=Html::textInput('archivo', '', ['id'=>'arc']); //Se quedará en blanco
}

/*
Código para que el docente no pueda ver los detalles de avance hasta que el alumno suba un archivo y muestre un aviso.
Esto lo hace a partir del valor de '$archivo', si está en blanco significa que aún no ha subido ningún archivo, de lo contrario
significa que hay un archivo subido.
*/
$js= "
    $(document).ready(function(){
        var arch = $('#arc').val();
        if(!arch == ''){
            $('#boton').attr('class','btn btn-primary');
            $('#dv').attr('class','alert alert-success');
            $('#lab').text('El alumno ha envíado su archivo');
        } else{
            $('#boton').attr('class','btn btn-primary disabled');
            $('#lab').text('El alumno aún no ha enviado su archivo');
        }
    });
";
$this->registerJs($js);
?>
<div class="tesis-view">

    <div class="alert alert-info", id="dv">
        <?= Html::label("", "lab", ['id'=>'lab']) ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Presentación de Avance', ['avance/index', 'id'=>$model->id], ['class' => 'btn btn-primary', 'id'=>'boton']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'titulo',
            'objetivo',
            'nestudiante_id',
            'ndirector',
            'ncodirector',
            'nsecretario',
            'nvocal',
            'estado',
        ],
    ]) ?>

    <div style="display: none">
        <?= $etiqueta ?>
    </div>

</div>
