<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Estudiantes".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string|null $numero_control
 * @property string|null $apellido_paterno
 * @property string|null $apellido_materno
 * @property string|null $genero
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $nivel_academico
 * @property string|null $becario
 * @property string|null $cvu
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Tesis[] $teses
 * @property User $usuario
 */
class Estudiantes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Estudiantes';
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
            [['numero_control', 'apellido_paterno', 'apellido_materno', 'direccion', 'telefono', 'nivel_academico', 'becario', 'cvu'], 'string', 'max' => 255],
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
            'numero_control' => 'Numero Control',
            'apellido_paterno' => 'Apellido Paterno',
            'apellido_materno' => 'Apellido Materno',
            'genero' => 'Genero',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'nivel_academico' => 'Nivel Academico',
            'becario' => 'Becario',
            'cvu' => 'Cvu',
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
        return $this->hasMany(Tesis::class, ['estudiante_id' => 'id']);
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
}
