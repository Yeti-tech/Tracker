<?php

use app\models\tracker\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var User $user */
?>

<?php $form = ActiveForm::begin([
    'id' => 'user',
    'options' => ['class' => 'form-horizontal'],
]) ?>

<?= $form->field($user, 'name')->textInput() ?>
<?= $form->field($user, 'surname')->textInput() ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Добавить пользователя', ['class' => 'btn btn-warning']) ?>
        </div>
    </div>

<?php ActiveForm::end() ?>