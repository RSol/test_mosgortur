<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $groups [] */
/* @var $skills [] */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-md-2">

            <p>
                <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <div class="panel panel-primary">
                <div class="panel-heading">Search</div>
                <div class="panel-body">
                    <?= $this->render('_search', [
                        'model' => $searchModel,
                        'groups' => $groups,
                        'skills' => $skills,
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'name',
                    [
                        'attribute' => 'group',
                        'filter' => ArrayHelper::map($groups, 'id', 'name'),
                        'value' => function ($data) {
                            /**
                             * @var \app\models\User $data
                             */
                            return implode(', ', ArrayHelper::map($data->groups, 'id', 'name'));
                        }
                    ],
                    [
                        'attribute' => 'skill',
                        'filter' => ArrayHelper::map($skills, 'id', 'name'),
                        'value' => function ($data) {
                            /**
                             * @var \app\models\User $data
                             */
                            return implode(', ', ArrayHelper::map($data->skills, 'id', 'name'));
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
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
