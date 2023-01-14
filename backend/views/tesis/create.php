<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tesis $model */

$this->title = 'Registrar Tema de Tesis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tesis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
