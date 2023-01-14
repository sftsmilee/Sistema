<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TesisSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tesis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'estudiante_id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'objetivo') ?>

    <?= $form->field($model, 'director') ?>

    <?php // echo $form->field($model, 'codirector') ?>

    <?php // echo $form->field($model, 'secretario') ?>

    <?php // echo $form->field($model, 'vocal') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
