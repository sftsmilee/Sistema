<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Calificaciones;

/**
 * CalificacionesSearch represents the model behind the search form of `common\models\Calificaciones`.
 */
class CalificacionesSearch extends Calificaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_avance', 'id_docente', 'p1', 'p2', 'p3', 'p4', 'p5', 'p6', 'p7', 'p8'], 'integer'],
            [['tipo'], 'safe'],
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
        $query = Calificaciones::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_avance' => $this->id_avance,
            'id_docente' => $this->id_docente,
            'p1' => $this->p1,
            'p2' => $this->p2,
            'p3' => $this->p3,
            'p4' => $this->p4,
            'p5' => $this->p5,
            'p6' => $this->p6,
            'p7' => $this->p7,
            'p8' => $this->p8,
        ]);

        $query->andFilterWhere(['ilike', 'tipo', $this->tipo]);

        return $dataProvider;
    }
}
