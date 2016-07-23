<?php

namespace c006\widget\banner\models\search;

use c006\widget\banner\models\WidgetBannerTransitionTypes as WidgetBannerTransitionTypesModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WidgetBannerTransitionTypes represents the model behind the search form about `c006\widget\banner\models\WidgetBannerTransitionTypes`.
 */
class WidgetBannerTransitionTypes extends WidgetBannerTransitionTypesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
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
        $query = WidgetBannerTransitionTypesModel::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
