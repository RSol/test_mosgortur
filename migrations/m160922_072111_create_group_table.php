<?php

use yii\db\Migration;

/**
 * Handles the creation for table `group`.
 */
class m160922_072111_create_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->createTable('group_user', [
            'group_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('group_user_group', 'group_user', 'group_id', 'group', 'id');
        $this->addForeignKey('group_user_user', 'group_user', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('group_user_group', 'group_user');
        $this->dropForeignKey('group_user_user', 'group_user');
        $this->dropTable('group_user');

        $this->dropTable('group');
    }
}
