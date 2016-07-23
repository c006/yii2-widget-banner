<?php

namespace c006\widget\banner\models\search;

use c006\widget\banner\models\WidgetBanner as WidgetBannerModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WidgetBanner represents the model behind the search form about `c006\widget\banner\models\WidgetBanner`.
 */
class WidgetBanner extends WidgetBannerModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transition_id', 'transition_type_id', 'transition_time', 'active'], 'integer'],
            [['name', 'css'], 'safe'],
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
        $query = WidgetBannerModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'                 => $this->id,
            'transition_id'      => $this->transition_id,
            'transition_type_id' => $this->transition_type_id,
            'transition_time'    => $this->transition_time,
            'active'             => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'css', $this->css]);

        return $dataProvider;
    }
}
