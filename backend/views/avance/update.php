<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Avance $model */

if($model->archivo){
    $this->title = 'Modiciar Fecha';
}else {
    $this->title = 'Programar Fecha';
}
//$this->params['breadcrumbs'][] = ['label' => 'Avances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Fecha de Presentación de Avance', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
