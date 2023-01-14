<?php

namespace common\models;

use Yii;
use yii\i18n\Formatter;

/**
 * This is the model class for table "Avance".
 *
 * @property int $id
 * @property int|null $id_tesis
 * @property string|null $fechahora
 * @property string|null $archivo
 *
 * @property Tesis $tesis
 */
class Avance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Avance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tesis'], 'default', 'value' => null],
            [['id_tesis'], 'integer'],
            [['fechahora'], 'safe'],
            [['archivo'], 'string', 'max' => 50],
            [['id_tesis'], 'exist', 'skipOnError' => true, 'targetClass' => Tesis::class, 'targetAttribute' => ['id_tesis' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tesis' => 'Id Tesis',
            'ntesis'=> 'Tesis', //Titulo de la tesis
            'fechahora' => 'Fecha y hora',
            'fecha' => 'Fecha', //Fecha de presentación
            'hora' => 'Hora', //Hora de presentación
            'archivo' => 'Archivo',
            'estado' => 'Estado de Archivo', //Estado del archivo
            'calificacion' => 'Calificacion Final' //Calificacion
        ];
    }

    /**
     * Gets query for [[Tesis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTesis()
    {
        return $this->hasOne(Tesis::class, ['id' => 'id_tesis']);
    }

    public function getFecha() //para mostrar solo la fecha
    {
        $aux=explode(" ", $this->fechahora);
        list($año, $mes, $dia) = explode("-", $aux[0]);
        return $dia."/".$mes."/".$año;
    }

    public function getHora() //para mostrar solo la hora
    {
        $aux=explode(" ", $this->fechahora);
        list($hora, $minuto, $segundos) = explode(":",$aux[1]);
        if($hora >= 12){
            $apm = "p.m.";
            if($hora>12){
                $hora-=12;
                if($hora<10){
                    $hora="0".$hora;
                }
            }
        } else{
            if($hora==0){
                $hora+=12;
            }
            $apm = "a.m.";
        }
        return $hora.":".$minuto." ".$apm;
    }

    public function getEstado() //Estado del archivo, si ya está subido o si está pendiente
    {
        $aux = $this->archivo;
        if($aux){
            return "Subido";
        } else{
            return "Pendiente";
        }
    }

    public function getNTesis(){ //Mostrar el titulo de la tesis
        $aux = Tesis::findOne(['id'=>$this->id_tesis]);
        return $aux->titulo;
    }

    public function getCalificacion(){ //Mostrar la calificacion final
        $director = Calificaciones::findOne(['id_avance'=>$this->id, 'tipo'=>'Director']);
        $secretario = Calificaciones::findOne(['id_avance'=>$this->id, 'tipo'=>'Secretario']);
        $vocal = Calificaciones::findOne(['id_avance'=>$this->id, 'tipo'=>'Vocal']);
        if($director){
            $cd = $director->getPromedio();
        }else{
            return 'Pendiente'; //Si aún no ha calificado el director
        }
        if($secretario){
            $cs = $secretario->getPromedio();
        }else{
            return 'Pendiente'; //Si aún no ha calificado el secretario
        }
        if($vocal){
            $cv = $vocal->getPromedio();
        }else{
            return 'Pendiente'; //Si aún no ha calificado el vocal
        }
        $ct = ($cd+$cs+$cv)/3;
        return number_format($ct, 2); //Calificacion promedio
    }
}
