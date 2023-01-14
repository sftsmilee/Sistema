<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Tesis".
 *
 * @property int $id
 * @property int|null $estudiante_id
 * @property string|null $titulo
 * @property string|null $objetivo
 * @property int|null $director
 * @property int|null $codirector
 * @property int|null $secretario
 * @property int|null $vocal
 * @property string|null $estado
 *
 * @property Docentes $codirector0
 * @property Docentes $director0
 * @property Estudiantes $estudiante
 * @property Docentes $secretario0
 * @property Docentes $vocal0
 */
class Tesis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tesis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estudiante_id', 'director', 'codirector', 'secretario', 'vocal'], 'default', 'value' => null],
            [['estudiante_id', 'director', 'codirector', 'secretario', 'vocal'], 'integer'],
            [['titulo', 'estado'], 'string', 'max' => 255],
            [['objetivo'], 'string', 'max' => 500],
            [['director'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::class, 'targetAttribute' => ['director' => 'id']],
            [['codirector'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::class, 'targetAttribute' => ['codirector' => 'id']],
            [['secretario'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::class, 'targetAttribute' => ['secretario' => 'id']],
            [['vocal'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::class, 'targetAttribute' => ['vocal' => 'id']],
            [['estudiante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiantes::class, 'targetAttribute' => ['estudiante_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estudiante_id' => 'Estudiante ID',
            'nestudiante_id' => 'Estudiante', //Nombre del estudiante
            'titulo' => 'Titulo',
            'objetivo' => 'Objetivo',
            'director' => 'Director',
            'ndirector' => 'Director', //Nombre del director
            'codirector' => 'Codirector',
            'ncodirector' => 'Codirector', //Nombre del codirector
            'secretario' => 'Secretario',
            'nsecretario' => 'Secretario', //Nombre del secretario
            'vocal' => 'Vocal',
            'nvocal' => 'Vocal', //Nombre del vocal
            'estado' => 'Estado', //Estado de la tesis, aprobada o pendiente
        ];
    }

    /**
     * Gets query for [[Codirector0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodirector0()
    {
        return $this->hasOne(Docentes::class, ['id' => 'codirector']);
    }

    /**
     * Gets query for [[Director0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirector0()
    {
        return $this->hasOne(Docentes::class, ['id' => 'director']);
    }

    /**
     * Gets query for [[Estudiante]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiante()
    {
        return $this->hasOne(Estudiantes::class, ['id' => 'estudiante_id']);
    }

    /**
     * Gets query for [[Secretario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSecretario0()
    {
        return $this->hasOne(Docentes::class, ['id' => 'secretario']);
    }

    /**
     * Gets query for [[Vocal0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVocal0()
    {
        return $this->hasOne(Docentes::class, ['id' => 'vocal']);
    }

    public function getNEstudiante_ID(){ //Muestra el nombre completo del estudiante
        $aux=Estudiantes::findOne(['id'=>$this->estudiante_id]);
        return $aux?$aux->nombre." ".$aux->apellido_paterno." ".$aux->apellido_materno:'---';
    }

    public function getNDirector(){ //Muestra el nombre completo del director
        $aux=Docentes::findOne(['id'=>$this->director]);
        return $aux?$aux->nombre." ".$aux->apellido_paterno." ".$aux->apellido_materno:'---';
    }

    public function getNCodirector(){ //Muestra el nombre completo del codirector
        $aux=Docentes::findOne(['id'=>$this->codirector]);
        return $aux?$aux->nombre." ".$aux->apellido_paterno." ".$aux->apellido_materno:'---';
    }

    public function getNSecretario(){ //Muestra el nombre completo del secretario
        $aux=Docentes::findOne(['id'=>$this->secretario]);
        return $aux?$aux->nombre." ".$aux->apellido_paterno." ".$aux->apellido_materno:'---';
    }

    public function getNVocal(){ //Muestra el nombre completo del vocal
        $aux=Docentes::findOne(['id'=>$this->vocal]);
        return $aux?$aux->nombre." ".$aux->apellido_paterno." ".$aux->apellido_materno:'---';
    }
}
