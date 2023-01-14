<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Avance $model */

$this->title = 'Programar Fecha y Hora';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
