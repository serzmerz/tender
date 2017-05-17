<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;

/**
 * RequestSearch represents the model behind the search form about `app\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cost', 'company', 'id_tender'], 'integer'],
            [['description', 'deadline', 'tender.name', 'company0.name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Build data provider instance with search query applied
     * @param $params
     * @param $query
     * @return ActiveDataProvider
     */
    public function searchBody($params, $query)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['tender' => function ($query) {
            $query->from(['tender' => 'tenders']);
        }]);
        // добавляем сортировку по колонке из зависимости
        $dataProvider->sort->attributes['tender.name'] = [
            'asc' => ['tender.name' => SORT_ASC],
            'desc' => ['tender.name' => SORT_DESC],
        ];

        $query->joinWith(['company0' => function ($query) {
            $query->from(['company0' => 'company']);
        }]);
        // добавляем сортировку по колонке из зависимости
        $dataProvider->sort->attributes['company0.name'] = [
            'asc' => ['company0.name' => SORT_ASC],
            'desc' => ['company0.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cost' => $this->cost,
            'deadline' => $this->deadline,
            'company' => $this->company,
            'id_tender' => $this->id_tender,
        ]);

        $query->andFilterWhere(['LIKE', 'tender.name', $this->getAttribute('tender.name')]);
        $query->andFilterWhere(['LIKE', 'company0.name', $this->getAttribute('company0.name')]);
        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
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
        $query = Request::find()->with('tender')->with('company0');// add conditions that should always apply here
        return $this->searchBody($params, $query);
    }

    /**
     * Creates data provider instance with search query applied with id tender
     *
     * @param $params
     * @param $id
     * @return ActiveDataProvider
     */
    public function searchForTender($params, $id)
    {
        $query = Request::find()->where(['id_tender' => $id])->with('tender')->with('company0');
        return $this->searchBody($params, $query);
    }

    /**
     * делаем поле зависимости доступным для поиска
     *
     * @return array
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['tender.name'], ['company0.name']);
    }

}
