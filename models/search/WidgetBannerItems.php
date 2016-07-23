<?php

namespace c006\widget\banner\models\search;

use c006\widget\banner\models\WidgetBannerItems as WidgetBannerItemsModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WidgetBannerItems represents the model behind the search form about `c006\widget\banner\models\WidgetBannerItems`.
 */
class WidgetBannerItems extends WidgetBannerItemsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banner_id', 'date_start', 'date_start_hour', 'date_end', 'date_end_hour', 'file_id', 'pause'], 'integer'],
            [['name', 'url', 'alt_text'], 'safe'],
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
        $query = WidgetBannerItemsModel::find();

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
            'id'              => $this->id,
            'banner_id'       => $this->banner_id,
            'date_start'      => $this->date_start,
            'date_start_hour' => $this->date_start_hour,
            'date_end'        => $this->date_end,
            'date_end_hour'   => $this->date_end_hour,
            'file_id'         => $this->file_id,
            'pause'           => $this->pause,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'alt_text', $this->alt_text]);

        return $dataProvider;
    }
}
