<?php

namespace app\models\tracker;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 *
 * @property Task[] $tasks
 */
class User extends \yii\db\ActiveRecord
{

    public static function tableName(): string
    {
        return 'user';
    }

    public function rules(): array
    {
        return [
            [['name', 'surname'], 'required'],
            [['name', 'surname'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
        ];
    }

    /**
     * Gets query for [[Tasks]]
     */
    public function getTasks(): ActiveQuery
    {
        return $this->hasMany(Task::class, ['user_id' => 'id']);
    }

    public function getDisplayName(): string
    {
        return $this->name . ' ' . $this->surname;
    }
}
