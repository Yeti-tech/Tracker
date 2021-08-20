<?php

namespace app\controllers;

use app\helpers\TaskHelper;
use app\models\tracker\TaskSearch;
use Yii;
use yii\web\Controller;
use app\models\tracker\Task;
use yii\web\Response;

class TaskController extends Controller
{
    public function actionNew()
    {
        $task = new Task();

        if ($task->load(\Yii::$app->request->post()) && $task->validate()) {
            $task->status = Task::STATUS_NEW;
            $task->save();

            return $this->redirect(['task/list']);
        }

        return $this->render('new', [
            'task' => $task,
        ]);

    }

    public function actionList(): string
    {
        TaskHelper::checkDeadline();

        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionUpdate(int $id)
    {
        try {
            $task = Task::find()->where(['id' => $id])->one();

            if ($task->load(\Yii::$app->request->post()) && $task->validate()) {
                if ($task->status === TASK::STATUS_COMPLETED) {
                    $task->finished_at = date('y-m-d');
                }
                $task->save();

                Yii::$app->session->setFlash('successUpdate', 'успешно сохранено!');
                return $this->redirect(['task/list']);
            }

            return $this->render('update', [
                'task' => $task,
            ]);
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('errorUpdate', 'ошибка при редактировании');
            return $this->redirect(['task/list']);
        }
    }

    public function actionDelete(int $id): Response
    {
        try {
            $task = Task::find()->where(['id' => $id])->one();
            $task->delete();
        } catch (\Throwable $e) {
            Yii::$app->session->setFlash('errorDelete', 'ошибка при удалении');
            return $this->redirect(['task/list']);
        }

        Yii::$app->session->setFlash('successDelete', 'успешно удалено!');
        return $this->redirect(['task/list']);
    }
}