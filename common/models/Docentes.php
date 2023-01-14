<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Docentes".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string|null $sni
 * @property string|null $nombre
 * @property string|null $apellido_paterno
 * @property string|null $apellido_materno
 * @property string|null $genero
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $catedras
 * @property string|null $tipo_investigador
 * @property string|null $nivel_academico
 * @property string|null $puesto
 * @property string|null $jornada
 * @property string|null $cursos
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Tesis[] $teses
 * @property Tesis[] $teses0
 * @property Tesis[] $teses1
 * @property Tesis[] $teses2
 * @property User $usuario
 */
class Docentes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Docentes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id'], 'required'],
            [['usuario_id'], 'default', 'value' => null],
            [['usuario_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['sni', 'nombre', 'apellido_paterno', 'apellido_materno', 'direccion', 'telefono', 'catedras', 'tipo_investigador', 'nivel_academico', 'puesto', 'jornada', 'cursos'], 'string', 'max' => 255],
            [['genero'], 'string', 'max' => 20],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'sni' => 'Sni',
            'nombre' => 'Nombre',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'genero' => 'Genero',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'catedras' => 'Catedras',
            'tipo_investigador' => 'Tipo Investigador',
            'nivel_academico' => 'Nivel Academico',
            'puesto' => 'Puesto',
            'jornada' => 'Jornada',
            'cursos' => 'Cursos',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Teses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeses()
    {
        return $this->hasMany(Tesis::class, ['director' => 'id']);
    }

    /**
     * Gets query for [[Teses0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeses0()
    {
        return $this->hasMany(Tesis::class, ['codirector' => 'id']);
    }

    /**
     * Gets query for [[Teses1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeses1()
    {
        return $this->hasMany(Tesis::class, ['secretario' => 'id']);
    }

    /**
     * Gets query for [[Teses2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeses2()
    {
        return $this->hasMany(Tesis::class, ['vocal' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::class, ['id' => 'usuario_id']);
    }

    public static function ListaDocentes(){ //Para generar lista de Docentes
        $lista = Docentes::find()->asArray()->all();
        $listaV = ArrayHelper::map(
            $lista,
            'id',
            function ($lista, $defaultValue){
                return $lista['nombre'] . ' ' . $lista['apellido_paterno'] . ' ' . $lista['apellido_materno'];
            });
        return $listaV;
    }
}
