<?php

namespace backend\controllers;

use common\models\Avance;
use backend\models\AvanceSearch;
use common\models\Docentes;
use common\models\Estudiantes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AvanceController implements the CRUD actions for Avance model.
 */
class AvanceController extends Controller
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
     * Lists all Avance models.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $idE=\Yii::$app->user->identity->id;
        $estudiante=Estudiantes::findOne(['usuario_id'=>$idE]);
        $docente=Docentes::findOne(['usuario_id'=>$idE]);
        $avance = Avance::findOne(['id_tesis'=>$id]);
        if($estudiante){ //si el usuario es estudiante
            return $this->redirect(['view2', 'id'=>$avance->id]); //Vista de avance alumno, para subir su archivo
        } elseif($docente){ //si el usuario es docente
            return $this->redirect(['view3', 'id'=>$avance->id]); //Vista de avance docente, para evaluar avance
        } else { //si el usuario es coordinador
            if($avance){ //si hay un avance programado
                return $this->redirect(['view', 'id'=>$avance->id]); //Vista de avance coordinador, modificar fecha
            }else{ // si no hay un avance programado
                return $this->redirect(['create', 'id'=>$id]); //Vista para programar fecha de presentacion
            }
        }
    }

    /**
     * Displays a single Avance model.
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
     * Displays a single Avance model.
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
     * Displays a single Avance model.
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
     * Creates a new Avance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new Avance();
        $model->id_tesis=$id; //Añade el id de la tesis

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
     * Updates an existing Avance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) { //codigo necesario para subir archivos
            $archivo = UploadedFile::getInstance($model, 'archivo');
            if(!is_null($archivo)){
                $ext_a = explode(".", $archivo->name);
                $ext = $ext_a[1];
                $model->archivo = 'archivo'.\Yii::$app->security->generateRandomString().".{$ext}";
                \Yii::$app->params['uploadPath'] = \Yii::$app->basePath . '/web/uploads/archivos/';
                $path = \Yii::$app->params['uploadPath'] . $model->archivo;
                $archivo->saveAs($path);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdate2($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) { //codigo necesario para subir archivos
            $archivo = UploadedFile::getInstance($model, 'archivo');
            if(!is_null($archivo)){
                $ext_a = explode(".", $archivo->name);
                $ext = $ext_a[1];
                $model->archivo = 'archivo'.\Yii::$app->security->generateRandomString().".{$ext}";
                \Yii::$app->params['uploadPath'] = \Yii::$app->basePath . '/web/uploads/archivos/';
                $path = \Yii::$app->params['uploadPath'] . $model->archivo;
                $archivo->saveAs($path);
            }
            $model->save();
            return $this->redirect(['view2', 'id' => $model->id]);
        }
        return $this->render('update2', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Avance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $archivo = $this->findModel($id)->archivo;
        if($archivo){
            unlink(\Yii::$app->basePath.'/web/uploads/archivos/'.$archivo);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Avance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Avance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avance::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
