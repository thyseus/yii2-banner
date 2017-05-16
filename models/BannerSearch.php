<?php

namespace thyseus\banner\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use thyseus\banner\models\Banner;

/**
 * BannerSearch represents the model behind the search form of `thyseus\banner\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visit_count'], 'integer'],
            [['title', 'slug', 'image', 'url', 'client', 'adspace', 'created_at', 'updated_at', 'valid_from', 'valid_until', 'comment', 'active'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Banner::find();

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
            'visit_count' => $this->visit_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'active' => $this->active,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'adspace', $this->adspace])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
