<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 *
 * @property GroupUser[] $groupUsers
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupUsers()
    {
        return $this->hasMany(GroupUser::className(), ['group_id' => 'id']);
    }
}
