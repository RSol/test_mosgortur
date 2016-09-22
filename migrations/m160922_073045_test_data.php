<?php

use yii\db\Migration;

class m160922_073045_test_data extends Migration
{
    public function up()
    {
        $userRows = \yii\helpers\ArrayHelper::map(range(0, 200), function ($i) {
            return $i;
        }, function ($i) {
            return [
                'name' => uniqid('user_'),
                'in_place' => ($i % 4) == 2,
            ];
        });
        $this->batchInsert('user', ['name', 'in_place'], $userRows);

        $skillRows = \yii\helpers\ArrayHelper::map(range(0, 6), function ($i) {
            return $i;
        }, function ($i) {
            return [
                'name' => "skill_{$i}",
            ];
        });
        $this->batchInsert('skill', ['name'], $skillRows);

        $groupRows = \yii\helpers\ArrayHelper::map(range(0, 6), function ($i) {
            return $i;
        }, function ($i) {
            return [
                'name' => "group_{$i}",
            ];
        });
        $this->batchInsert('group', ['name'], $groupRows);

        $skillUserRows = [];
        foreach ($userRows as $k => $v) {
            $len = rand(1, 6);
            $skills = [];
            for ($i = 1; $i <= $len; $i++) {
                while (in_array($skill = rand(1, 7), $skills)) {
                    continue;
                }
                $skills[] = $skill;
                $skillUserRows[] = [
                    'skill_id' => $skill,
                    'user_id' => $k + 1,
                ];
            }
        }
        $this->batchInsert('skill_user', ['skill_id', 'user_id'], $skillUserRows);

        $groupUserRows = [];
        foreach ($userRows as $k => $v) {
            $len = rand(1, 6);
            $groups = [];
            for ($i = 1; $i <= $len; $i++) {
                while (in_array($group = rand(1, 7), $groups)) {
                    continue;
                }
                $groups[] = $group;
                $groupUserRows[] = [
                    'group_id' => $group,
                    'user_id' => $k + 1,
                ];
            }
        }
        $this->batchInsert('group_user', ['group_id', 'user_id'], $groupUserRows);

    }

    public function down()
    {

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
