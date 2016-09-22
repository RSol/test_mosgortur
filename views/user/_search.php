<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $groups [] */
/* @var $skills [] */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'in_place')->dropDownList(\app\models\User::places(), [
        'prompt' => 'Select one',
    ]) ?>

    <?= $form->field($model, 'group')->dropDownList(ArrayHelper::map($groups, 'id', 'name'), [
        'prompt' => 'Select group',
    ]) ?>

    <?= $form->field($model, 'skill')->dropDownList(ArrayHelper::map($skills, 'id', 'name'), [
        'prompt' => 'Select skill',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
