<?php
/**
 * This model get list of City in bd
 */

namespace app\models;


use yii\db\ActiveRecord;

class City extends ActiveRecord
{

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
}