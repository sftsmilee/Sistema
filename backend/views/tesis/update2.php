<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */

$this->title = 'Modificar Tema de Tesis';
//$this->params['breadcrumbs'][] = ['label' => 'Teses', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tesis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
