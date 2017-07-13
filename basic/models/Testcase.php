<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testcases".
 *
 * @property integer $id
 * @property string $start
 * @property string $end
 *
 * @property Samples[] $samples
 */
class Testcase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testcases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start' => 'Start',
            'end' => 'End',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasMany(Samples::className(), ['testcases_id' => 'id']);
    }
}
