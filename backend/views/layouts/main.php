<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\models\Estudiantes;
use common\models\Docentes;
use common\models\Tesis;
use common\models\Avance;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [ //Si el usuario es docente o coordinador
        ['label' => 'Inicio', 'url' => ['/site/index']],
        ['label' => 'Ver Tesis', 'url' => ['/tesis/index']],
    ];
    $id = Yii::$app->user->identity->id;
    $estudiante=Estudiantes::findOne(['usuario_id'=>$id]);
    if($estudiante){
        $tesis=Tesis::findOne(['estudiante_id'=>$estudiante->id]);
        if($tesis){
            $avance=Avance::findOne(['id_tesis'=>$tesis->id]);
            if($avance){ //Si el usuario es estudiante, tiene una tesis y hay un avance programado
                $menuItems = [
                    ['label' => 'Inicio', 'url' => ['/site/index']],
                    ['label' => 'Tema de Tesis', 'url' => ['/tesis/index']],
                    ['label' => 'Presentación de Avance', 'url' => ['/avance/index', 'id'=>$tesis->id]],
                ];
            }else { //Si el usuario es estudiante, tiene una tesis pero no tiene avance programado
                $menuItems = [
                    ['label' => 'Inicio', 'url' => ['/site/index']],
                    ['label' => 'Tema de Tesis', 'url' => ['/tesis/index']],
                ];
            }
        } else{ // Si el usuario es estudiante y no tiene tesis
            $menuItems = [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Tema de Tesis', 'url' => ['/tesis/index']],
            ];
        }
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }     
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Salir (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
