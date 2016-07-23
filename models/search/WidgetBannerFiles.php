<?php

namespace c006\widget\banner\models\search;

use c006\widget\banner\models\WidgetBannerFiles as WidgetBannerFilesModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WidgetBannerFiles represents the model behind the search form about `c006\widget\banner\models\WidgetBannerFiles`.
 */
class WidgetBannerFiles extends WidgetBannerFilesModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'width', 'height'], 'integer'],
            [['name', 'file'], 'safe'],
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
        $query = WidgetBannerFilesModel::find();

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
            'id'     => $this->id,
            'width'  => $this->width,
            'height' => $this->height,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
