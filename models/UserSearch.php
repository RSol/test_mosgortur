<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\db\Query;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group', 'skill'], 'integer'],
            [['in_place'], 'in', 'range' => array_keys(static::places())],
            [['id', 'name'], 'safe'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'in_place' => $this->in_place,
        ]);

        if ($this->skill) {
            $query->andFilterWhere([
                'id' => (new Query())
                    ->select('user_id')
                    ->from('skill_user')
                    ->where([
                        'skill_id' => $this->skill,
                    ])
            ]);
        }

        if ($this->group) {
            $query->andFilterWhere([
                'id' => (new Query())
                    ->select('user_id')
                    ->from('group_user')
                    ->where([
                        'group_id' => $this->group,
                    ])
            ]);
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'id', $this->id]);

        return $dataProvider;
    }
}
