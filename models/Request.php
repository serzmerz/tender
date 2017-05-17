<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property string $description
 * @property integer $cost
 * @property string $deadline
 * @property integer $company
 * @property integer $id_tender
 *
 * @property Company $company0
 * @property Tenders $idTender
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'cost', 'deadline', 'company', 'id_tender'], 'required'],
            [['description'], 'string'],
            [['cost', 'company'], 'integer'],
            [['deadline'], 'safe'],
            [['company'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company' => 'id']],
            [['id_tender'], 'exist', 'skipOnError' => true, 'targetClass' => Tenders::className(), 'targetAttribute' => ['id_tender' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'cost' => 'Cost',
            'deadline' => 'Deadline',
            'company0.name' => 'Company',
            'tender.name' => 'Tender name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany0()
    {
        return $this->hasOne(Company::className(), ['id' => 'company']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTender()
    {
        return $this->hasOne(Tenders::className(), ['id' => 'id_tender']);
    }
}
