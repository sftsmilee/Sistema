<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */

$aux = $model->estado;
if($aux == "Pendiente"){
    $this->title = 'Asignar Comite Tutorial';
}else{
    $this->title = 'Modificar Comite Tutorial';
}
//$this->params['breadcrumbs'][] = ['label' => 'Teses', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tesis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
