<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Tesis;
use common\models\Estudiantes;
use common\models\Avance;
use common\models\Calificaciones;

/** @var yii\web\View $this */
/** @var common\models\Calificaciones $model */

$this->title = 'Evaluación Avance';
/*$id = Yii::$app->user->identity->id;
$estudiante=Estudiantes::findOne(['usuario_id'=>$id]);
$tesis = Tesis::findOne(['estudiante_id'=>$estudiante->id]);
$avance = Avance::findOne(['id_tesis'=>$tesis->id]);*/
$avance = Avance::findOne(['id'=>$model->id_avance]);
$tesis = Tesis::findOne(['id'=>$avance->id_tesis]);
$estudiante = Estudiantes::findOne(['id'=>$tesis->estudiante_id]);

$cald = Calificaciones::findOne(['id_avance'=>$avance->id, 'tipo'=>'Director']);
if(!$cald){
    $pd1='---';
    $pd2='---';
    $pd3='---';
    $pd4='---';
    $pd5='---';
    $pd6='---';
    $pd7='---';
    $pd8='---';
    $prd='---';
}else{
    $pd1=$cald->p1;
    $pd2=$cald->p2;
    $pd3=$cald->p3;
    $pd4=$cald->p4;
    $pd5=$cald->p5;
    $pd6=$cald->p6;
    $pd7=$cald->p7;
    $pd8=$cald->p8;
    $prd = number_format($cald->getPromedio(),2);
}

$cals = Calificaciones::findOne(['id_avance'=>$avance->id, 'tipo'=>'Secretario']);
if(!$cals){
    $ps1='---';
    $ps2='---';
    $ps3='---';
    $ps4='---';
    $ps5='---';
    $ps6='---';
    $ps7='---';
    $ps8='---';
    $prs='---';
}else{
    $ps1=$cals->p1;
    $ps2=$cals->p2;
    $ps3=$cals->p3;
    $ps4=$cals->p4;
    $ps5=$cals->p5;
    $ps6=$cals->p6;
    $ps7=$cals->p7;
    $ps8=$cals->p8;
    $prs = number_format($cals->getPromedio(),2);
}

$calv = Calificaciones::findOne(['id_avance'=>$avance->id, 'tipo'=>'Vocal']);
if(!$calv){
    $pv1='---';
    $pv2='---';
    $pv3='---';
    $pv4='---';
    $pv5='---';
    $pv6='---';
    $pv7='---';
    $pv8='---';
    $prv='---';
}else{
    $pv1=$calv->p1;
    $pv2=$calv->p2;
    $pv3=$calv->p3;
    $pv4=$calv->p4;
    $pv5=$calv->p5;
    $pv6=$calv->p6;
    $pv7=$calv->p7;
    $pv8=$calv->p8;
    $prv = number_format($calv->getPromedio(),2);
}

if(!$cald || !$cals || !$calv){
    $final = '---';
}else{
    $final = number_format($avance->getCalificacion(), 2);
}

$this->params['breadcrumbs'][] = ['label' => 'Presentación de Avance', 'url' => ['/avance/index', 'id'=>$tesis->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-9wq8{border-color:inherit;text-align:center;vertical-align:middle}
    .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    .tg .tg-7btt{border-color:inherit;font-weight:bold;text-align:center;vertical-align:top}
    .tg .tg-fymr{border-color:inherit;font-weight:bold;text-align:left;vertical-align:top}
    .tg .tg-6ic8{border-color:inherit;font-weight:bold;text-align:right;vertical-align:top}
    .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 679px">
    <colgroup>
        <col style="width: 427px">
        <col style="width: 87px">
        <col style="width: 85px">
        <col style="width: 80px">
    </colgroup>
    <thead>
    <tr>
        <th class="tg-7btt">Criterios a Evaluar</th>
        <th class="tg-7btt">Director</th>
        <th class="tg-7btt">Secretario</th>
        <th class="tg-7btt">Vocal</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="tg-fymr">1. Estructura y claridad del documento</td>
        <td class="tg-c3ow">
            <?= $pd1 ?>
        </td>
        <td class="tg-c3ow">
            <?= $ps1 ?>
        </td>
        <td class="tg-c3ow">
            <?= $pv1 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-fymr">2. Amplitud y actualidad de la información utilizada</td>
        <td class="tg-c3ow">
            <?= $pd2 ?>
        </td>
        <td class="tg-c3ow">
            <?= $ps2 ?>
        </td>
        <td class="tg-c3ow">
            <?= $pv2 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-fymr">3. Grado de avance con respecto de la información utilizada</td>
        <td class="tg-c3ow">
            <?= $pd3 ?>
        </td>
        <td class="tg-c3ow">
            <?= $ps3 ?>
        </td>
        <td class="tg-c3ow">
            <?= $pv3 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-fymr">4. Nivel Técnico empleado en el informe</td>
        <td class="tg-c3ow">
            <?= $pd4 ?>
        </td>
        <td class="tg-c3ow">
            <?= $ps4 ?>
        </td>
        <td class="tg-c3ow">
            <?= $pv4 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-fymr">5. Asertividad en la explicación de la aportación en el avance</td>
        <td class="tg-c3ow">
            <?= $pd5 ?>
        </td>
        <td class="tg-c3ow">
            <?= $ps5 ?>
        </td>
        <td class="tg-c3ow">
            <?= $pv5 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-fymr">6. Nivel de propuesta de las actividades futuras</td>
        <td class="tg-c3ow">
            <?= $pd6 ?>
        </td>
        <td class="tg-c3ow">
            <?= $ps6 ?>
        </td>
        <td class="tg-c3ow">
            <?= $pv6 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-fymr">7. Apreciación general de la información recibida</td>
        <td class="tg-c3ow">
            <?= $pd7 ?>
        </td>
        <td class="tg-c3ow">
            <?= $ps7 ?>
        </td>
        <td class="tg-c3ow">
            <?= $pv7 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-fymr">8. Grado de avance con respecto al cronograma propuesto en el anteproyecto</td>
        <td class="tg-9wq8">
            <?= $pd8 ?>
        </td>
        <td class="tg-9wq8">
            <?= $ps8 ?>
        </td>
        <td class="tg-9wq8">
            <?= $pv8 ?>
        </td>
    </tr>
    <tr>
        <td class="tg-6ic8">Promedio</td>
        <td class="tg-c3ow">
            <?= $prd ?>
        </td>
        <td class="tg-c3ow">
            <?= $prs ?>
        </td>
        <td class="tg-c3ow">
            <?= $prv ?>
        </td>
    </tr>
    <tr>
        <td class="tg-6ic8">Calificación Final</td>
        <td class="tg-c3ow" colspan="3">
            <?= $final ?>
        </td>
    </tr>
    </tbody>
</table>


