<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "remote".
 *
 * @property integer $id
 * @property string $UUID
 * @property integer $samples_id
 * @property integer $samples_testcases_id
 *
 * @property Samples $samples
 */
class Remote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'remote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UUID', 'samples_id', 'samples_testcases_id'], 'required'],
            [['samples_id', 'samples_testcases_id'], 'integer'],
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
            'id' => 'ID',
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
