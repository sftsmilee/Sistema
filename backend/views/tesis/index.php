<?php

use common\models\Tesis;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\TesisSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lista de Tesis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tesis-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'rowOptions'=>function($model, $key, $index, $grid){
            if($model->estado == 'Pendiente'){
                return ['style'=>'background-color: #FCFFA5;'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'titulo',
            //'objetivo',
            'nestudiante_id',
            'ndirector',
            'ncodirector',
            'nsecretario',
            'nvocal',
            'estado',
            [
                'class' => ActionColumn::className(),
                //'header'=>'Detalles',
                'template' => '{view}',
                'urlCreator' => function ($action, Tesis $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
