<?php

namespace app\models\tracker;

use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property integer $taskName
 * @property string $deadline
 * @property string|null $finished_at
 * @property string $status
 * @property int $user_id
 * @property string $description
 *
 * @property User $user
 */
class TaskSearch extends Task
{
    public function rules(): array
    {
        return [
            [['taskName'], 'string'],
            [['deadline', 'finished_at'], 'safe'],
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['status'], 'string', 'max' => 250],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Task::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'status' => $this->status,
            'finished_at' => $this->finished_at,
            'deadline' => $this->deadline,
        ]);
        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', 'taskName', $this->taskName]);

        return $dataProvider;
    }
}
