<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Sistema Posgrado</h1>
            <p class="fs-5 fw-light">Bienvenido al sistema posgrado del ITM</p>
            <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::toRoute(['site/signup'])?>">Entrar al Sistema</a></p>
            <!-- Para poner rutas a otros sitios \yii\helpers\Url::toRoute(['Patata'])-->
        </div>
    </div>

