<?php

namespace backend\models;

use common\models\Docentes;
use common\models\Estudiantes;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tesis;

/**
 * TesisSearch represents the model behind the search form of `common\models\Tesis`.
 */
class TesisSearch extends Tesis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'estudiante_id', 'director', 'codirector', 'secretario', 'vocal'], 'integer'],
            [['titulo', 'objetivo', 'estado'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $id = \Yii::$app->user->identity->id;
        $docente = Docentes::findOne(['usuario_id'=>$id]);
        if($docente){ //si el usuario es docente solo mostrará las tesis donde sea parte del comite tutorial
            $query = Tesis::find()->where(['director'=>$docente->id])
                ->orWhere(['codirector'=>$docente->id])
                ->orWhere(['secretario'=>$docente->id])
                ->orWhere(['vocal'=>$docente->id]);
        }else{ // si el usuario es coordinador mostrará todas las tesis
            $query = Tesis::find();
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$no=Estudiantes::findOne(['id'=>$this->estudiante_id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'estudiante_id' => $this->estudiante_id,
            'director' => $this->director,
            'codirector' => $this->codirector,
            'secretario' => $this->secretario,
            'vocal' => $this->vocal,
        ]);

        $query->andFilterWhere(['ilike', 'titulo', $this->titulo])
            ->andFilterWhere(['ilike', 'objetivo', $this->objetivo])
            ->andFilterWhere(['ilike', 'estado', $this->estado]);

        return $dataProvider;
    }
}
