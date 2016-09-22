<?php

use yii\db\Migration;

/**
 * Handles the creation for table `skill`.
 */
class m160922_072100_create_skill_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('skill', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->createTable('skill_user', [
            'skill_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('skill_user_skill', 'skill_user', 'skill_id', 'skill', 'id');
        $this->addForeignKey('skill_user_user', 'skill_user', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('skill_user_skill', 'skill_user');
        $this->dropForeignKey('skill_user_user', 'skill_user');
        $this->dropTable('skill_user');

        $this->dropTable('skill');
    }
}
