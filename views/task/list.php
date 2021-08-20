<?php

use yii\i18n\Formatter;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\date\DatePicker;
use app\models\tracker\Task;
use app\models\tracker\User;

/** @var ActiveDataProvider $dataProvider */
/** @var Task $searchModel */

?>

<style>
    .alert {
        width: 30%;
    }

    .alert-success {
        background-color: #c3e6cb;
    }
</style>

<?php if (Yii::$app->session->hasFlash('successUpdate')): ?>
    <div class="alert alert-success alert-dismissible align-items-center py-2 pl-4 pr-3"
         role="alert">
        <i class="fa fa-check"></i>
        <?php echo Yii::$app->session->getFlash('successUpdate') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
    </div>
<?php endif; ?>


<?php if (Yii::$app->session->hasFlash('errorUpdate')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <i class="fa fa-check"></i>
        <?= Yii::$app->session->getFlash('errorUpdate') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
    </div>
<?php endif ?>


<?php if (Yii::$app->session->hasFlash('successDelete')): ?>
    <div class="alert alert-success alert-dismissible align-items-center py-2 pl-4 pr-3"
         role="alert">
        <i class="fa fa-check"></i>
        <?= Yii::$app->session->getFlash('successDelete') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
    </div>
<?php endif ?>


<?php if (Yii::$app->session->hasFlash('errorDelete')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <i class="fa fa-check"></i>
        <?= Yii::$app->session->getFlash('errorDelete') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
    </div>
<?php endif ?>


<?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'summary' => false,
            'formatter' => ['class' => Formatter::class, 'nullDisplay' => ''],
            'filterModel' => $searchModel,
            'rowOptions' => static function ($task, $key, $index, $grid) {
                if ($task->outdated && !$task->finished_at) {
                    return ['class' => 'danger'];
                }
            },
            'columns' => [
                ['class' => SerialColumn::class],
                [
                    'attribute' => 'taskName',
                    'label' => 'Задача',
                ],
                [
                    'attribute' => 'description',
                    'label' => 'Описание',
                ],
                [
                    'attribute' => 'user_id',
                    'label' => 'Пользователь',
                    'format' => 'text',
                    'value' => static function (Task $task) {
                        return $task->user->getDisplayName();
                    },
                    'filter' => ArrayHelper::map(User::find()->select(['name', 'surname', 'id'])->all(),
                        'id', 'displayName'),
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Cтатус',
                    'value' => static function (Task $task) {
                        return Task::STATUSES[$task->status];
                    },
                    'filter' => Task::STATUSES,
                ],
                [
                    'attribute' => 'deadline',
                    'label' => 'Срок выполнения',
                    'format' => 'date',
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'deadline',
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите дату'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                        ]
                    ])
                ],
                [
                    'attribute' => 'finished_at',
                    'label' => 'Дата выполнения',
                    'format' => 'date',
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'finished_at',
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выберите дату'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                        ]
                    ])
                ],
                [
                    'class' => ActionColumn::class,
                    'header' => false,
                    'headerOptions' => ['width' => '80'],
                    'template' => '{update} {delete}',

                    'buttons' => [
                        'update' => static function ($url, Task $task, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                ['task/update', 'id' => $task->id]);
                        },
                        'delete' => static function ($url, Task $task, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                [
                                    'task/delete',
                                    'id' => $task->id,
                                ],
                                ['title' => Yii::t('app', 'Delete'),
                                    'data-confirm' => Yii::t('app', 'Are you sure?')]);
                        }
                    ],
                ],
            ]
        ]
    )
?>
<br>
<?= Html::a('Новая задача', ['task/new'], ['class' => 'btn btn-default']) ?>
<br>
<br>
<?= Html::a('Новый пользователь', ['user/new'], ['class' => 'btn btn-default']) ?>






