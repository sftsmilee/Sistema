<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Calificaciones $model */

$this->title = 'Evaluar Avance';
$this->params['breadcrumbs'][] = ['label' => 'Calificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calificaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
