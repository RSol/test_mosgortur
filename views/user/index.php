<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'group',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Group::find()->asArray()->all(), 'id', 'name'),
                'value' => function($data) {
                    /**
                     * @var \app\models\User $data
                     */
                    return implode(', ', \yii\helpers\ArrayHelper::map($data->groups, 'id', 'name'));
                }
            ],
            [
                'attribute' => 'skill',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Skill::find()->asArray()->all(), 'id', 'name'),
                'value' => function($data) {
                    /**
                     * @var \app\models\User $data
                     */
                    return implode(', ', \yii\helpers\ArrayHelper::map($data->skills, 'id', 'name'));
                }
            ],
            [
                'attribute' => 'in_place',
                'filter' => \app\models\User::places(),
                'value' => function ($data) {
                    /**
                     * @var \app\models\User $data
                     */
                    $places = \app\models\User::places();
                    return $places[$data->in_place];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
