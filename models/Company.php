<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $tel
 * @property string $contact_per
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
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
            [['name', 'address', 'tel', 'contact_per'], 'required'],
            [['tel'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 50],
            [['contact_per'], 'string', 'max' => 20],
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
            'address' => 'Address',
            'tel' => 'Tel',
            'contact_per' => 'Contact Per',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['company' => 'id']);
    }
}
