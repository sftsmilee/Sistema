<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */

$this->title = 'Validar Tema de Tesis';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Tesis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tesis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aprobar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('No Aprobar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estás seguro de no aprobar esta tesis?',
                'method' => 'post',
            ],
        ]) ?>
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

</div>
