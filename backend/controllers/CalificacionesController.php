<?php

namespace backend\controllers;

use common\models\Avance;
use common\models\Calificaciones;
use backend\models\CalificacionesSearch;
use common\models\Docentes;
use common\models\Estudiantes;
use common\models\Tesis;
use PhpParser\Comment\Doc;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CalificacionesController implements the CRUD actions for Calificaciones model.
 */
class CalificacionesController extends Controller
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
     * Lists all Calificaciones models.
     *
     * @return string
     */
    public function actionIndex($id, $idT)
    {
        if($idT==0){ // Si el usuario es estudiante o coordinador
            $calc = Calificaciones::findOne(['id_avance'=>$id]);
            $this->redirect(['view2', 'id'=>$calc->id]); // Vista para ver evaluación
        }else{
            $idD = \Yii::$app->user->identity->id;
            $docente = Docentes::findOne(['usuario_id'=>$idD]);
            $cal = Calificaciones::findOne(['id_avance'=>$id, 'id_docente'=>$docente->id]);
            if($cal){
                $this->redirect(['view', 'id'=>$cal->id]); //Vista de ver evaluación
            } else{
                $this->redirect(['create', 'id'=>$id]); //Vista para evaluar
            }
        }
        /*$searchModel = new CalificacionesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
    }

    /**
     * Displays a single Calificaciones model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Calificaciones model.
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
     * Creates a new Calificaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new Calificaciones();
        $idD = \Yii::$app->user->identity->id;
        $docente = Docentes::findOne(['usuario_id'=>$idD]);
        $tesis = Tesis::findOne(['id'=>Avance::findOne(['id'=>$id])->id_tesis]);
        $model->id_avance=$id; //Añade el id del avance
        $model->id_docente=$docente->id; //Añade el id del docente
        if($tesis->director == $docente->id){
            $model->tipo="Director"; //Añade que la evaluación es del director
        } elseif($tesis->codirector == $docente->id){
            $model->tipo="Codirector"; //Añade que la evaluación es del codirector
        } elseif($tesis->secretario == $docente->id){
            $model->tipo="Secretario"; //Añade que la evaluación es del secretario
        } elseif($tesis->vocal == $docente->id){
            $model->tipo="Vocal"; //Añade que la evaluación es del vocal
        }
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Calificaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Calificaciones model.
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
     * Finds the Calificaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Calificaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Calificaciones::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
