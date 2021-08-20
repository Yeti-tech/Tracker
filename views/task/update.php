<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\tracker\Task;
use kartik\select2\Select2;

/** @var Task $task */ ?>

<?php $form = ActiveForm::begin([
    'id' => 'task_update',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<?= $form->field($task, 'taskName')->textInput() ?>
<?= $form->field($task, 'deadline')->input('date') ?>
<?= $form->field($task, 'description')->textInput() ?>
<?= $form->field($task, 'status')->widget(Select2::class, [
        'data' => Task::STATUSES,
        'pluginOptions' => [
            'disabled' => $task->status === Task::STATUS_COMPLETED,
        ]
    ]) ?>

<br>
<?= Html::submitButton('Применить', ['class' => 'btn btn-light']) ?>
<?php ActiveForm::end() ?>

