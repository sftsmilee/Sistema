<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Calificaciones $model */

$this->title = 'Evaluación Avance';
//$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="calificaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar Evaluación', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'ndocente',
            'tipo',
            'p1',
            'p2',
            'p3',
            'p4',
            'p5',
            'p6',
            'p7',
            'p8',
            [
                'attribute'=>'promedio',
                'format'=>['decimal',2]
            ],
        ],
    ]) ?>

</div>
