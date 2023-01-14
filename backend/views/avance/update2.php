<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Avance $model */

if($model->archivo){
    $this->title = "Modificar Archivo";
}else {
    $this->title = "Subir Archivo";
}
//$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Presentación de Avance', 'url' => ['view2', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
