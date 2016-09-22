<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property integer $in_place
 *
 * @property Group[] $groups
 * @property Skill[] $skills
 */
class User extends \yii\db\ActiveRecord
{
    public $group;
    public $skill;

    const IN_PLACE_NO = 0;
    const IN_PLACE_YES = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'in_place'], 'required'],
            [['in_place'], 'in', 'range' => array_keys(static::places())],
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
            'in_place' => 'In Place',
            'group' => 'Groups',
            'skill' => 'Skills',
        ];
    }

    public static function places()
    {
        return [
            static::IN_PLACE_NO => 'No',
            static::IN_PLACE_YES => 'Yes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'group_id'])
            ->viaTable('group_user', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id' => 'skill_id'])
            ->viaTable('skill_user', ['user_id' => 'id']);
    }
}
