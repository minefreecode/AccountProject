<?php

namespace app\modules\economic_account_act\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\economic_account_act\models\Subject;

/**
 * SubjectSearch represents the model behind the search form of `app\models\Subject`.
 */
class SubjectSearch extends Subject
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rcbic'], 'integer'],
            [['full_name', 'address', 'inn', 'kipp', 'current_account', 'correspondent_account', 'bank'], 'safe'],
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
        $query = Subject::find();

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
            'rcbic' => $this->rcbic,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'kipp', $this->kipp])
            ->andFilterWhere(['like', 'current_account', $this->current_account])
            ->andFilterWhere(['like', 'correspondent_account', $this->correspondent_account])
            ->andFilterWhere(['like', 'bank', $this->bank]);

        return $dataProvider;
    }
}
