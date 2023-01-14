<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CalificacionesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="calificaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_avance') ?>

    <?= $form->field($model, 'id_docente') ?>

    <?= $form->field($model, 'tipo') ?>

    <?= $form->field($model, 'p1') ?>

    <?php // echo $form->field($model, 'p2') ?>

    <?php // echo $form->field($model, 'p3') ?>

    <?php // echo $form->field($model, 'p4') ?>

    <?php // echo $form->field($model, 'p5') ?>

    <?php // echo $form->field($model, 'p6') ?>

    <?php // echo $form->field($model, 'p7') ?>

    <?php // echo $form->field($model, 'p8') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
