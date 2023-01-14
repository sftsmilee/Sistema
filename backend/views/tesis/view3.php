<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */

$this->title = 'Tema de Tesis Validado';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Tesis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tesis-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar Comite Tutorial', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Presentación de Avance', ['avance/index', 'id'=>$model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Oficio', ['prueba', 'id'=>$model->id], ['class' => 'btn btn-primary']) ?>
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
