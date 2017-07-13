<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "samples".
 *
 * @property integer $id
 * @property string $timestamp
 * @property double $latitude
 * @property double $longitude
 * @property string $UUID
 * @property integer $testcases_id
 *
 * @property Proximity[] $proximities
 * @property Remote[] $remotes
 * @property Testcases $testcases
 */
class Sample extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'samples';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
            [['latitude', 'longitude', 'UUID', 'testcases_id'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['testcases_id'], 'integer'],
            [['UUID'], 'string', 'max' => 128],
            [['testcases_id'], 'exist', 'skipOnError' => true, 'targetClass' => Testcase::className(), 'targetAttribute' => ['testcases_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'UUID' => 'Uuid',
            'testcases_id' => 'Testcases ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProximities()
    {
        return $this->hasMany(Proximity::className(), ['samples_id' => 'id', 'samples_testcases_id' => 'testcases_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemotes()
    {
        return $this->hasMany(Remote::className(), ['samples_id' => 'id', 'samples_testcases_id' => 'testcases_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestcases()
    {
        return $this->hasOne(Testcase::className(), ['id' => 'testcases_id']);
    }
}
