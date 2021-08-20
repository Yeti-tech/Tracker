<?php


namespace app\controllers;

use yii\web\Controller;
use app\models\tracker\User;

class UserController extends Controller
{

    public function actionNew()
    {
        $user = new User;
        if ($user->load(\Yii::$app->request->post()) && $user->validate()) {
            $user->save();
            return $this->redirect(['task/list']);

        }
        return $this->render('new', [
            'user' => $user,
        ]);
    }

}