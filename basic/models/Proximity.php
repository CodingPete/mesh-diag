<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proximity".
 *
 * @property integer $ID
 * @property string $UUID
 * @property integer $samples_id
 * @property integer $samples_testcases_id
 *
 * @property Samples $samples
 */
class Proximity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proximity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'UUID', 'samples_id', 'samples_testcases_id'], 'required'],
            [['ID', 'samples_id', 'samples_testcases_id'], 'integer'],
            [['UUID'], 'string', 'max' => 128],
            [['samples_id', 'samples_testcases_id'], 'exist', 'skipOnError' => true, 'targetClass' => Samples::className(), 'targetAttribute' => ['samples_id' => 'id', 'samples_testcases_id' => 'testcases_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'UUID' => 'Uuid',
            'samples_id' => 'Samples ID',
            'samples_testcases_id' => 'Samples Testcases ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasOne(Samples::className(), ['id' => 'samples_id', 'testcases_id' => 'samples_testcases_id']);
    }
}
