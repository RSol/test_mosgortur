<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property integer $id
 * @property string $name
 *
 * @property SkillUser[] $skillUsers
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skill';
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
    public function getSkillUsers()
    {
        return $this->hasMany(SkillUser::className(), ['skill_id' => 'id']);
    }
}
