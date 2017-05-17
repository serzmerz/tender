<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tenders".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $budget
 * @property string $deadline
 *
 * @property Request[] $requests
 */
class Tenders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tenders';
    }

    /**
     * Build array with name companies for dropdown
     *
     * @return null or array companies
     */
    public static function dropdown()
    {

        static $dropdown;

        if ($dropdown === null) {

            $models = static::find()->all();

            foreach ($models as $model) {
                $dropdown[$model->id] = $model->name;
            }

        }

        return $dropdown;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'budget', 'deadline'], 'required'],
            [['description'], 'string'],
            [['budget'], 'integer'],
            [['deadline'], 'safe'],
            [['name'], 'string', 'max' => 30],
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
            'description' => 'Description',
            'budget' => 'Budget',
            'deadline' => 'Deadline',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['id_tender' => 'id']);
    }
}
