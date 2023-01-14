<?php

namespace backend\controllers;

use common\models\Docentes;
use common\models\Estudiantes;
use common\models\Tesis;
use backend\models\TesisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf;

/**
 * TesisController implements the CRUD actions for Tesis model.
 */
class TesisController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tesis models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $id=\Yii::$app->user->identity->id;
        $estudiante=Estudiantes::findOne(['usuario_id'=>$id]);
        if($estudiante){
            //El usuario es estudiante
            $tesis=Tesis::findOne(['estudiante_id'=>$estudiante->id]);
            if($tesis){
                //Si ha registrado una Tesis
                return $this->redirect(['view2','id'=>$tesis->id]);
            }else{
                //Si no ha registrado una Tesis
                return $this->redirect(['create']);
            }
        }
        //El usuario no es estudiante
        $searchModel = new TesisSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tesis model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) //Ver tesis
    {
        $idD=\Yii::$app->user->identity->id;
        $docente=Docentes::findOne(['usuario_id'=>$idD]);
        $est = Tesis::findOne(['id'=>$id]);
        if($docente){ //Tesis docentes
            return $this->render('view4', [ //Vista docentes
                'model' => $this->findModel($id),
            ]);
        }
        if($est->estado == 'Pendiente'){ //Tesis sin Validar
            return $this->render('view', [ //Vista coordinador para tesis sin validar
                'model' => $this->findModel($id),
            ]);
        } else { // Tesis Validadas
            return $this->render('view3', [ // Vista coordinador para tesis validadas
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Displays a single Tesis model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView2($id)
    {
        return $this->render('view2', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Tesis model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView3($id)
    {
        return $this->render('view3', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Tesis model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView4($id)
    {
        return $this->render('view4', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tesis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tesis();
        $id=\Yii::$app->user->identity->id;
        $model->estudiante_id=Estudiantes::findOne(['usuario_id'=>$id]); //Añade el id del estudiante

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view2', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tesis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view3', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tesis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate2($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view2', 'id' => $model->id]);
        }

        return $this->render('update2', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tesis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tesis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tesis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tesis::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrueba($id) { // Para imprimir el oficio
        $model = Tesis::findOne($id);
        $content = $this->renderPartial('_prueba', [
            'model' => $model,
            // etc...
        ]);
        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_UTF8, // leaner size using standard fonts
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => [
                'title' => 'Factuur',
                'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
        //return $pdf->render(); Para renderizar en pdf, no funciona por la versión de PHP
        return $content;
    }
}
