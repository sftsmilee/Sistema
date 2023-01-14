<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Calificaciones".
 *
 * @property int $id
 * @property int|null $id_avance
 * @property int|null $id_docente
 * @property string|null $tipo
 * @property int $p1
 * @property int $p2
 * @property int $p3
 * @property int $p4
 * @property int $p5
 * @property int $p6
 * @property int $p7
 * @property int $p8
 *
 * @property Avance $avance
 * @property Docentes $docente
 */
class Calificaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Calificaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_avance', 'id_docente', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8'], 'default', 'value' => null],
            [['id_avance', 'id_docente', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8'], 'integer'],
            [['p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8'], 'required'],
            [['tipo'], 'string', 'max' => 15],
            [['id_avance'], 'exist', 'skipOnError' => true, 'targetClass' => Avance::class, 'targetAttribute' => ['id_avance' => 'id']],
            [['id_docente'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::class, 'targetAttribute' => ['id_docente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_avance' => 'Id Avance',
            'id_docente' => 'Id Docente',
            'tipo' => 'Miembro del comite',
            'p1' => '1. Estructura y claridad del documento',
            'p2' => '2. Amplitud y actualidad de la información utilizada',
            'p3' => '3. Grado de avance con respecto al informe anterior',
            'p4' => '4. Nivel técnico empleado en el informe',
            'p5' => '5. Asertividad en la explicación de la aportación en el avance',
            'p6' => '6. Nivel de propuesta de las actividades futuras',
            'p7' => '7. Apreciación general de la información recibida',
            'p8' => '8. Grado de avance con respecto al cronograma propuesto en el anteproyecto',
            'promedio' => 'Promedio',
            'ndocente' => 'Docente', //Nombre del docente
        ];
    }

    /**
     * Gets query for [[Avance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvance()
    {
        return $this->hasOne(Avance::class, ['id' => 'id_avance']);
    }

    /**
     * Gets query for [[Docente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocente()
    {
        return $this->hasOne(Docentes::class, ['id' => 'id_docente']);
    }

    public function getPromedio(){ // Mostrar promedio de todas las calificaciones
        return ($this->p1+$this->p2+$this->p3+$this->p4+$this->p5+$this->p6+$this->p7+$this->p8)/8;;
    }

    public function getNDocente(){ // Mostrar nombre del docente
        $aux=Docentes::findOne(['id'=>$this->id_docente]);
        return $aux?$aux->nombre." ".$aux->apellido_paterno." ".$aux->apellido_materno:'---';
    }
}
