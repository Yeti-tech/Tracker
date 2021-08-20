<?php

namespace app\models\tracker;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $taskName
 * @property string|null $description
 * @property int $user_id
 * @property string|null $status
 * @property string $deadline
 * @property string|null $finished_at
 * @property int|null $outdated
 *
 * @property User $user
 */
class Task extends \yii\db\ActiveRecord
{
    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';

    public const STATUSES = [
        self::STATUS_NEW => 'Добавлена',
        self::STATUS_IN_PROGRESS => 'В работе',
        self::STATUS_COMPLETED => 'Завершена',
    ];

    public static function tableName(): string
    {
        return 'task';
    }

    public function rules(): array
    {
        return [
            [['taskName', 'user_id'], 'required'],
            [['deadline'], 'required', 'message' => 'Поле не может быть пустым!'],
            [['taskName', 'description'], 'string'],
            [['user_id', 'outdated'], 'integer'],
            [['finished_at'], 'safe'],
            [['status'], 'string', 'max' => 125],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'taskName' => 'Задача',
            'description' => 'Описание',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'deadline' => 'Срок выполнения',
            'finished_at' => 'Дата выполнения',
        ];
    }

    /**
     * Gets query for [[User]].
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
