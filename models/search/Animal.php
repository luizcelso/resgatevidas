<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Animal as AnimalModel;

/**
* Animal represents the model behind the search form about `app\models\Animal`.
*/
class Animal extends AnimalModel
{
/**
* @inheritdoc
*/
public function rules()
{
return [
[['id', 'animal_type_id', 'status_id', 'username_id'], 'integer'],
            [['location', 'name', 'extra_information', 'updated_at', 'created_at', 'photo'], 'safe'],
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
$query = AnimalModel::find();

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

$this->load($params);

if (!$this->validate()) {
// uncomment the following line if you do not want to any records when validation fails
// $query->where('0=1');
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'animal_type_id' => $this->animal_type_id,
            'status_id' => $this->status_id,
            'username_id' => $this->username_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'extra_information', $this->extra_information])
            ->andFilterWhere(['like', 'photo', $this->photo]);

return $dataProvider;
}
}