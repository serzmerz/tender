<?php
/**
 * Created by PhpStorm.
 * User: tansk
 * Date: 27.02.2017
 * Time: 15:13
 */

namespace app\models;



use yii\db\ActiveRecord;

class Country extends ActiveRecord
{

        public static function dropdown()
    {
        static $dropdown;
        if($dropdown === null) {
            $models = static::find()->all();
            foreach ($models as $model) {
                $dropdown[$model->id] = $model->name;
            }
        }
        return $dropdown;
    }
}