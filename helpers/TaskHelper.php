<?php

namespace app\helpers;

use app\models\tracker\Task;

class TaskHelper
{
    public static function checkDeadline(): void
    {
        $tasks = Task::find()->all();
        $today = date('Y-m-d');

        foreach ($tasks as $key => $task) {
            if ($today > $task->deadline) {
                $task->outdated = 1;
                $task->save();
            }
        }
    }
}