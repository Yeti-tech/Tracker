<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\tracker\Task;
use app\models\tracker\User;
use kartik\select2\Select2;

/** @var User $user */
/** @var Task $task */
?>

<?= Html::a('Все задачи', ['task/list'], ['class' => "btn btn-secondary"]) ?>

<?php $form = ActiveForm::begin([
    'id' => 'task',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<?= $form->field($task, 'taskName')->textInput() ?>
<?= $form->field($task, 'description')->textInput() ?>
<?= $form->field($task, 'deadline')->input('date') ?>

<?= $form->field($task, 'user_id')->widget(Select2::class, [
        'data' => ArrayHelper::map(User::find()
            ->select(['name', 'surname', 'id'])
            ->all(), 'id', 'displayName'),
    ])
?>

<?= Html::submitButton('Добавить', ['class' => "btn btn-primary"]) ?>
<?php ActiveForm::end() ?>


